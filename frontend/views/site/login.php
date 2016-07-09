<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4">
            <h1><?= Html::encode($this->title) ?></h1>
        
            <br>
            
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4">
<pre class="site-helper">
&bull; Default accounts : 
   <strong>Administrator - admin/111111 
   User          - user/111111</strong>
                       
&bull; You can also create your own account by <strong><?= Html::a('signing up',Url::to(['site/signup']))?></strong>.
</pre>
        </div>            
    </div>

</div>

