<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use frontend\models\destination\Destination;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class DestinationController extends Controller
{
   
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Destination::find()->where(['active'=>true])->orderBy('name'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);        
        return $this->render('index',['dataProvider'=>$dataProvider]);
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