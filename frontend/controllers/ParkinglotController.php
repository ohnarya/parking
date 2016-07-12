<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use frontend\models\parking\ParkingLot;
use frontend\models\parking\ParkinglotSearchForm;
use frontend\models\parking\LotResult;
use frontend\models\destination\Destination;
use frontend\models\Users;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ParkinglotController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['search', 'index','view','save','store','delete'],
                'rules' => [
                    [
                        'actions' => ['search','store'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['search','index','view','save','store','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }    

    public function actionIndex()
    {
        if (!Yii::$app->user->can('manageParkingLots')) return $this->goHome();
        
        $dataProvider = new ActiveDataProvider([
            'query' => Parkinglot::find()->where(['active'=>true])->orderBy('permit'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);        
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
    public function actionView($id=null)
    {
        if (!Yii::$app->user->can('manageParkingLots')) return $this->goHome();
        
        if(isset($id)){
            $model = ParkingLot::find()->where(['id'=>$id,'active'=>true])->one();
        }else{
            $model = new ParkingLot(); 
        }
        return $this->render('view',['model'=>$model]);
    }
    
    public function actionSave($id=null)
    {
        if (!Yii::$app->user->can('manageParkingLots')) return $this->goHome();
        
        if(isset($id)){
            $model = ParkingLot::findOne($id);
        }else{
            $model = new ParkingLot();
        }
        $model->load(\Yii::$app->request->post());
        $model->save();
        
        return $this->redirect(['index']);
    }
    public function actionStore()
    {
        $dest = \Yii::$app->request->post('dest');
        $lot  = \Yii::$app->request->post('lot');;
        if(!$dest || !$lot) return false;
        
        // store history in destination
        $destination =  Destination::find()->where(['name'=>$dest])->one();
        $history=Json::decode($destination['history']);
        $history[$lot]++;
        $destination->history = Json::encode($history);
        $destination->save();
        unset($history);
        
        // store history in user only if when user is logined
        if(!Yii::$app->user->isGuest){
            $user = Users::findOne(Yii::$app->user->identity->id);
            $history = Json::decode($user['history']);
            $history[$dest][$lot]++;
            $user->history = Json::encode($history);
            $user->save();
        }

        return true;
    }
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('manageParkingLots')) return $this->goHome();
        
        $model = ParkingLot::findOne($id);
        $model->delete();
        return $this->redirect(Url::to(['parkinglot/index']));
    }
    
    public function actionSearch()
    {
        date_default_timezone_set('America/Chicago');         

        $user = Users::findOne(Yii::$app->user->identity->id);

        $parkinglot = ParkingLot::find()->select('permit')->where(['active'=>true])->all();
        $destination = Destination::find()->select('name')->where(['active'=>true])->all();
        $destarray = ArrayHelper::map($destination, 'name', 'name');
        $parkarray = ArrayHelper::map($parkinglot, 'permit', 'permit');        

        $model = new ParkinglotSearchForm();        
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
    protected function reasoning($condition)
    {
        $destination = Destination::find()->select(['place','history'])->where(['name'=>$condition['destination']])->one();

        // get all available parking lots which meet regulations and rules
        $list = $this->getCandidate($condition);

        // retreive distance and duration from google
        $list = $this->getDataFromGoogle($list, $destination['place']);
        
        // calculate  closest distance and shortest duration
        $suggestions = $this->calculate($list, Json::decode($destination['history']));
        
        $s = $this->preferable($list, $condition);
        if($s) $suggestions[] = $s;
        
        return $suggestions;
        
    }
    private function preferable($list, $condition)
    {

        $points = [];
        $user = Users::findOne(Yii::$app->user->identity->id);
        $history = Json::decode($user['history'])[$condition['destination']];
       
        // calculate scores based on preference
        foreach($list as $l){
          
            if($condition['easyparking'] && $l['easyparking']) $points[$l['permit']]++;
            if($condition['easyexit'] && $l['easyexit']) $points[$l['permit']]++;
            
            // myhistory is only for login users
            if($condition['myhistory'] && !Yii::$app->user->isGuest && isset($history) && $history[$l['permit']]){
                $points[$l['permit']] = $points[$l['permit']] + $history[$l['permit']];
            }
        }
       
        // get the best score
        foreach($points as $p => $score){
            if(!isset($preferable) || $preferable['score'] < $score ){
                $preferable['score'] = $score;
                $preferable['permit'] = $p;
            }
        }

        $suggestion['category']='preferable';
        foreach($list as $r){
            if($r['permit'] === $preferable['permit']){
                $suggestion['lot'] = $r; break;
            }
        }
        return $suggestion;
        
    }
    private function calculate($list, $history)
    {
        $suggestions = [];
        $cnt=0;
        foreach($list as $r){
           
            // closest
            if(!isset($closest) || $closest['distance']['value'] > $r['distance']['value']){
               
                $closest = $r;
            }

            // most often
            if( $history && array_key_exists($r['permit'], $history) && $cnt < $history[$r['permit']] ){
                $mostoften = $r;
                $cnt = $history[$r['permit']];
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
     * get distance and duration info from Google
     * ********************************************/
    private function getDataFromGoogle($list, $destplace)
    {

        $url = Yii::$app->params['googleDM'];
        $param['units']        = 'imperial';
        $param['mode']         = 'walking';
        $param['avoid']        = 'indoor';
        $param['key']          = getenv('GOOGLE_KEY');
        $d = Json::decode($destplace);
        $param['destinations'] = $d['lat'].','.$d['lng'];  
        
        foreach($list as $k => $l){
            
            $o = Json::decode($l['place']);
            $param['origins'] = $o['lat'].','.$o['lng'];
            
            // generate URL to communicate to GoogleMAP
            $params = http_build_query($param);

            // get the result from GoogleMap
            $result = file_get_contents($url.$params);
            $result = Json::decode($result);
            
            if($result['status']==='OK'){
                $list[$k]['destination'] = $destplace;
                $list[$k]['distance'] = $result['rows'][0]['elements'][0]['distance'];
                $list[$k]['time']     = $result['rows'][0]['elements'][0]['duration'];
            }else{
                echo "GoogleMap Error.";
                break;
            }
            
        }
        return $list;
    }
    protected function getCandidate($condition)
    {
        $perm = $condition['permit'];
        $dest = $condition['destination'];
        $date = strtotime($condition['date']);
        $time = $condition['time'];

        //weekends?
        if(date('w', $date)==0 || date('w',$date)==6){
            $weekends = ParkingLot::find()->select(['permit','address','place','easyparking','easyexit'])->where(['construction'=>false,'active'=>true])->asArray()->all(); 
            foreach($weekends as $w){
                $list[$w['permit']] = $w;
                
            }
        }else{
            // summer parking?
            if(isset($date) && in_array(date('m',$date), ['06','07','08'])){
                $summer = ParkingLot::find()->select(['permit','address','place','easyparking','easyexit'])->where(['construction'=>false,'active'=>true])
                         ->andWhere(['summer'=>true])->asArray()->all();
                foreach($summer as $su){
                    $list[$su['permit']] = $su;
                }     
            }
    
            // night parking?
            if($time>=17 || $time<=8){
                $night = ParkingLot::find()->select(['permit','address','place','easyparking','easyexit'])->where(['construction'=>false,'active'=>true])
                         ->andWhere(['night'=>true])->asArray()->all();
                foreach($night as $n){
                    $list[$n['permit']] = $n;
                }  
            }
        }
        // add user's permit
        if(isset($perm) && $perm!='' ){
            $list[$perm] = ParkingLot::find()->select(['permit','address','place','easyparking','easyexit'])->where(['permit'=>$perm])->asArray()->one();
        }
        return array_values($list);
    }    
}
?>