<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use frontend\models\parking\ParkingLot;
use frontend\models\parking\ParkingForm;
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
        
        // first loading
        if(!$model->load(\Yii::$app->request->post())){
            $user = Users::findOne(Yii::$app->user->identity->id);
            $model->permit = Json::decode($user->permit);   
            
            $parkinglot = ParkingLot::find()->select('permit')->where(['active'=>true])->asArray()->all();
            $destination = Destination::find()->select('name')->where(['active'=>true])->asArray()->all();
            $destination = ArrayHelper::map($destination, 'name', 'name');
            $parkinglot = ArrayHelper::map($parkinglot, 'permit', 'permit');
        
            return $this->render('search',['model'=>$model,
                                           'parkinglot'=>$parkinglot,
                                           'destination'=>$destination,
                                           'lots'=>null]);            
        }
        $this->reasoning($model);
                
        
    }
    protected function reasoning($condition)
    {
        $destination = Destination::find()->where(['name'=>$condition['destination']])->one();

        // get all available parking lots which meet regulations and rules
        $list = $this->getCandidate($condition);

        $this->getCalculate($list, $destination);
        
        
        // $lots = [];
        
        // foreach($list as $l){
        //     $parkinglot = ParkingLot::find()->select(['lat','lng'])->where(['permit'=>$l])->asArray()->one();
        //     $lots[$l] = Json::encode(array_values($parkinglot));
        // }
        // print_r($lots);
        
    }
    protected function getCalculate($list, $destination)
    {
        $url = Yii::$app->params['googleDM'];
        $param['units'] = 'imperial';
        $param['travel'] = 'walking';
        $param['origins'] = $this->setOrigins($list);
        $param['destinations'] = $destination['lat'].','.$destination['lng'];
        $param['key'] = getenv('GOOGLE_KEY');
        
        
        // generate URL to communicate to GoogleMAP
        $params = http_build_query($param);
        
        // get the result from GoogleMap
        $result = file_get_contents($url.$params);
        
        $suggestions =[];
        $result = Json::decode($result);      
        print_r($result);
        
        if(isset($result['status']) && $result['status']=='OK'){
            for($i = 0; $i < count($result['origin_addresses']) ; $i++){
                $s = new LotResult();
                $s['permit'] = $list[$i]['permit'];
                $s['address'] = $result['origin_addresses'][$i];
                $s['lat'] = $list[$i]['lat'];
                $s['lng'] = $list[$i]['lng'];
                $s['distance'] = $result['rows'][$i]['elements'][0]['distance'];
                $s['time'] = $result['rows'][$i]['elements'][0]['duration'];
                
                $suggestions[] = $s;
            }
        
            print_r($suggestions);            
            
        }else{
            echo "GoogleMap Error.";
        }
    }
    private function setOrigins($list)
    {
        
        foreach($list as $l){
            $origins .= $l['lat'].','.$l['lng'].'|';    
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
            if(isset($time) && $time>=17){
    
               foreach($all as $lot){
                    if($lot['night'])   
                        $list[] = $lot;
                        unset($lot);
                }
            }
        }
        
        // add user's permit
        if(!isset($list[$perm]))
            $list[] = ParkingLot::find()->where(['permit'=>$perm])->asArray()->one();
        
        
        return $list;
    }
    public function actionView($id=null)
    {
        
        if(isset($id)){
            $model = ParkingForm::find()->where(['id'=>$id,'active'=>true])->one();
        }else{
            $model = new ParkingForm(); 
        }
        return $this->render('view',['model'=>$model]);
    }
    
    public function actionSave($id=null)
    {
        if(isset($id)){
            $model = ParkingForm::findOne($id);
        }else{
            $model = new ParkingForm();
        }
        $model->load(\Yii::$app->request->post());
        $model->save();
        
        return $this->redirect(['index']);
    }
    public function actionDelete($id)
    {
        $model = ParkingForm::findOne($id);
        $model->delete();
        return $this->redirect(Url::to(['parkinglot/index']));
    }
}
?>