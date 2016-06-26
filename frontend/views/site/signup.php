<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\SwitchInput;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>Set Parking Preference</h3>
        </div>
        <div class="col-md-2">
                <?= $form->field($model, 'easyparking')
                         ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>              
        </div>
        <div class="col-md-2">
                <?= $form->field($model, 'lessbusy')
                         ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>              
        </div>
    </div>    
    <div class="col-md-4">
        <div class="form-group pull-right">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
