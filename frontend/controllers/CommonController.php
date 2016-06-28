<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\web\Request;
use yii\web\Response;

class CommonController extends Controller
{
   
    public function actionIndex()
    {
        
        $id = (Yii::$app->request->post('id'));
        
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $data['result'] = getenv($id);    
       
            return $data;
        }
            
    }
    public function actionView($id=null)
    {
        
        if(isset($id)){
            $model = Destination::find()->where(['id'=>$id,'active'=>true])->one();
        }else{
            $model = new Destination(); 
        }
        return $this->render('view',['model'=>$model]);
    }
    
    public function actionSave($id=null)
    {
        if(isset($id)){
            $model = Destination::findOne($id);
        }else{
            $model = new Destination();
        }
        $model->load(\Yii::$app->request->post());
        $model->save();
        
        return $this->redirect(Url::to(['destination/index']));
    }
    public function actionDelete($id)
    {
        $model = Destination::findOne($id);
        $model->delete();
        return $this->redirect(Url::to(['destination/index']));
    }
}
?>