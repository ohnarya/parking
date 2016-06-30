<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use frontend\models\parking\ParkingLot;
// use frontend\models\parking\ParkingForm;
use frontend\models\parking\ParkinglotSearchForm;
use frontend\models\parking\LotResult;
use frontend\models\destination\Destination;
use frontend\models\Users;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ParkinglotController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Parkinglot::find()->where(['active'=>true]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);        
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
     public function actionSearch()
    {
        $model = new ParkinglotSearchForm();
        $user = Users::findOne(Yii::$app->user->identity->id);

        $parkinglot = ParkingLot::find()->where(['active'=>true])->all();
        $destination = Destination::find()->where(['active'=>true])->all();
        $destarray = ArrayHelper::map($destination, 'name', 'name');
        $parkarray = ArrayHelper::map($parkinglot, 'permit', 'permit');        

        
        if($model->load(\Yii::$app->request->post())){
            $suggestions=$this->reasoning($model); 
            
            $suggestionDP = new ArrayDataProvider([
                    'allModels'=>$suggestions
                ]);
        }else{ // first loading
            $model->permit = Json::decode($user->permit);   
            $model->easyparking = $user->easyparking;
            $model->easyexit = $user->easyexit;
            $model->myhistory =$user->myhistory;
        }

        return $this->render('search',['model'=>$model,
                                      'parkarray'=>$parkarray,
                                      'destarray'=>$destarray,
                                      'destination'=>$destination,
                                      'suggestionDP'=>$suggestionDP]);         
    }

    public function actionView($id=null)
    {
        
        if(isset($id)){
            $model = ParkingLot::find()->where(['id'=>$id,'active'=>true])->one();
        }else{
            $model = new ParkingLot(); 
        }
        return $this->render('view',['model'=>$model]);
    }
    
    public function actionSave($id=null)
    {
        if(isset($id)){
            $model = ParkingLot::findOne($id);
        }else{
            $model = new ParkingLot();
        }
        $model->load(\Yii::$app->request->post());
        $model->save();
        
        return $this->redirect(['index']);
    }
    public function actionDelete($id)
    {
        $model = ParkingLot::findOne($id);
        $model->delete();
        return $this->redirect(Url::to(['parkinglot/index']));
    }
    protected function reasoning($condition)
    {
        $destination = Destination::find()->where(['name'=>$condition['destination']])->one();

        // get all available parking lots which meet regulations and rules
        $list = $this->getCandidate($condition);

        // retreive distance and duration from google
        $lotresults = $this->getDataFromGoogle($list, $destination);
        
        // calculate  closest distance and shortest duration
        $suggestions = $this->calculate($lotresults, Json::decode($destination['history']));
        $s = $this->preferable($list, $lotresults, $condition);
        if($s) $suggestions[] = $s;
        
        return $suggestions;
        
    }
    private function preferable($list, $results, $condition)
    {

        $points = [];
        $user = Users::findOne(Yii::$app->user->identity->id);
        $history = Json::decode($user['history'])[$condition['destination']];
        if(!$history) return;
        
        // calculate scores based on preference
        foreach($list as $l){
            if($condition['easyparking'] && $l['easyparking']) $points[$l['permit']]++;
            if($condition['easyexit'] && $l['easyexit']) $points[$l['permit']]++;
            
            // myhistory is only for login users
            if(!Yii::$app->user->isGuest && isset($history) && $history[$l['permit']]){
                $points[$l['permit']] = $points[$l['permit']] + $history[$l['permit']];
            }
        }
        
        // get the best score
        foreach($points as $p => $score){
            if(!isset($preferable) || $preferable['score'] < $score){
                $preferable['permit'] = $p;
                $preferable['score'] = $score;
            }
        }
        
        $suggestion['category']='preferable';
        foreach($results as $r){
            if($r['permit'] === $preferable['permit']){
                $suggestion['lot'] = $r; break;
            }
        }

        return $suggestions;
        
    }
    private function calculate($results, $history)
    {
        $suggestions = [];

        foreach($results as $r){
            // closest
            if(!isset($closest) || $closest['distance']['value'] > $r['distance']['value']){
                $closest = $r;
            }
            // most often
            if(isset($history) && (!isset($cnt) || ( in_array($r['permit'], $history) && $cnt < $history['permit']['cnt']))){
                $mostoften = $r;
                $cnt = $history['permit']['cnt'];
            }
        }
        if($closest){
            $suggestions[0]['category'] = 'closest';
            $suggestions[0]['lot'] = $closest;
        }
        if($mostoften){
            $suggestions[1]['category'] = 'mostoften';
            $suggestions[1]['lot'] = $mostoften;
        }
    
        return $suggestions;
    }
    
    /**********************************************
     * 
     * get distance and duration info from Google
     * 
     * ********************************************/
    private function getDataFromGoogle($list, $destination)
    {
        $url = Yii::$app->params['googleDM'];
        $param['units']        = 'imperial';
        $param['travel']       = 'walking';
        $param['origins']      = $this->setOrigins($list);  // all the candidates parking lots
        $param['key']          = getenv('GOOGLE_KEY');
        $d = Json::decode($destination['place']);
        $param['destinations'] = $d['lat'].','.$d['lng'];  
        
        // generate URL to communicate to GoogleMAP
        $params = http_build_query($param);
        
        // get the result from GoogleMap
        $result = file_get_contents($url.$params);
        
        $lotinfo =[];
        $result = Json::decode($result);      
        
        if(isset($result['status']) && $result['status']=='OK'){
            for($i = 0; $i < count($result['origin_addresses']) ; $i++){
                $s = new LotResult();
                $s['permit']   = $list[$i]['permit'];
                $s['address']  = $result['origin_addresses'][$i];
                $s['place']    = $list[$i]['place'];
                $s['distance'] = $result['rows'][$i]['elements'][0]['distance'];
                $s['time']     = $result['rows'][$i]['elements'][0]['duration'];
                $s['destination'] = $destination['place'];  // destination place
                
                $lotinfo[] = $s;
            }
        
            return $lotinfo;
            
        }else{
            echo "GoogleMap Error.";
        }
    }
    private function setOrigins($list)
    {
        
        foreach($list as $l){
            $p = Json::decode($l['place']);
            $origins .= $p['lat'].','.$p['lng'].'|';    
        }
        
        return rtrim($origins, "|");
    }
    protected function getCandidate($condition)
    {
        $perm = $condition['permit'];
        $dest = $condition['destination'];
        $date = strtotime($condition['date']);
        $time = $condition['time'];
        $list = [];
        
        // get all available parking lot
        $all = ParkingLot::find()->where(['construction'=>false, 'active'=>true])->asArray()->all();
        
        // remove football
        foreach($all as $lot){
            // football will be removed : set condition later
            if($lot['football']) unset($lot);
        }
        
        // summer parking?
        if(isset($date) && in_array(date('m',$date), ['06','07','08'])){
            foreach($all as $lot){
                if($lot['summer'])   
                    $list[] = $lot;
                    unset($lot);
            }
        }
        // weekdays? 
        if(date('w', $date)>0&& date('w',$date)<6){
          
            // night parking?
            if(isset($time) &&  ( $time>=17 || $time<=8) ){
    
               foreach($all as $lot){
                    if($lot['night'])   
                        $list[] = $lot;
                        unset($lot);
                }
            }
        }else{  // weekends?
           foreach($all as $lot){
                $list[] = $lot;
                unset($lot);
            }            
        }
        
        // add user's permit
        if(!isset($list[$perm]))
            $list[] = ParkingLot::find()->where(['permit'=>$perm])->asArray()->one();
        
        
        return $list;
    }    
}
?>