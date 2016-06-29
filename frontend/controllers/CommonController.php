<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\web\Request;
use yii\web\Response;
use common\models\Client;

class CommonController extends Controller
{
   
    public function actionIndex()
    {
        
        $id = (Yii::$app->request->post('id'));
        // coutn the number of client info stored
        
        $cnt = Client::find()->count();
        if($cnt>50){
            $temp = Client::find()->limit(40)->all();
            foreach($temp as $t)
                $t->delete();
        }
        
        
        // client info
        $client = new Client();
        $client->userid = Yii::$app->user->identity->id;
        $client->ip = Yii::$app->request->getUserIP();
        $client->key = $id;
        $client->created_at = date("Y-m-d H:i:s");
        $client->save();
        
        
        // return data
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $data['result'] = getenv($id);    
            return $data;
        }
            
    }
}
?>