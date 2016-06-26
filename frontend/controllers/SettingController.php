<?php
namespace frontend\controllers;

use yii\web\Controller;

class SettingController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
?>