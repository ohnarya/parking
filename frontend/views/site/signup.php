<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\SwitchInput;

$this->title = 'Signup';
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4">    
            <h1><?= Html::encode($this->title) ?></h1>
        
            <br>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

            <hr>
                <?= $this->render("_lotinfo",['form'=>$form,'model'=>$model,'parkinglot'=>$parkinglot])?>       

                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4">
<pre class="site-helper">
&bull; Sign up to get parking lot suggestions based on your parking history.
  But, you can get the best parking lot suggestions without login or your account.
</pre>
        </div>            
    </div>    
    <?php ActiveForm::end(); ?>
</div>
