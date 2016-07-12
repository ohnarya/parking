<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use frontend\models\destination\Destination;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class DestinationController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','save','delete'],
                'rules' => [
                    [
                        'actions' => ['index','view','save','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }       

    public function actionIndex()
    {
        if (!Yii::$app->user->can('manageDestinations')) return $this->goHome();
        
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
        if (!Yii::$app->user->can('manageDestinations')) return $this->goHome();
        
        if(isset($id)){
            $model = Destination::find()->where(['id'=>$id,'active'=>true])->one();
        }else{
            $model = new Destination(); 
        }
        return $this->render('view',['model'=>$model]);
    }
    
    public function actionSave($id=null)
    {
        if (!Yii::$app->user->can('manageDestinations')) return $this->goHome();
        
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
        if (!Yii::$app->user->can('manageDestinations')) return $this->goHome();
        
        $model = Destination::findOne($id);
        $model->delete();
        return $this->redirect(Url::to(['destination/index']));
    }
}
?>