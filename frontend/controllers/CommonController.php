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
        $client = new Client();
        $client->ip = Yii::$app->request->getUserIP();
        $client->key = $id;
        $client->created_at = date("Y-m-d H:i:s");
        $client->save();
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $data['result'] = getenv($id);    
       
            return $data;
        }
            
    }
}
?>