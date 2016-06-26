<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use frontend\models\parking\ParkingLot;
use frontend\models\parking\ParkingForm;
use yii\helpers\Url;

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
    public function actionManage()
    {
        return $this->render('manage');
    }
}
?>