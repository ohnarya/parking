<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use frontend\models\parking\ParkingLot;
use frontend\models\parking\ParkingForm;
class ParkinglotController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
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
    public function actionView($id=null)
    {
        $model = new ParkingForm();
        if(isset($id)){
            $model = ParkingForm::find()->where(['ID'=>$id,'Active'=>true])->one();
        }
        return $this->render('view',['model'=>$model]);
    }
    
    public function actionSave($id=null)
    {
       
        $model = new ParkingForm();
        if(isset($id)){
             
            $model = ParkingForm::findOne($id);
            $model->active=false;
        }else{
            $model->load(\Yii::$app->request->post());
        }
        $model->save();
        
        return $this->redirect(['index']);
    }
    public function actionManage()
    {
        return $this->render('manage');
    }
}
?>