<?php
namespace frontend\views\site;

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use frontend\models\Users;
use yii\helpers\Url;
use yii\helpers\Json;

$this->title = 'Setting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(['id' => 'setting-form',    
                                             'action' => Url::to(['site/settingsave']),
                                             'method' =>'POST']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>
                
                <?= $form->field($model, 'permit')
                         ->dropdownList($parkinglot,['class'=>'form-control'//,'multiple'=>true,
                                                     ]); ?>
        <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Set Parking Preference</h3>
        </div>
        <div class="col-md-2">
                
                <?= $form->field($model,'easyparking')->checkbox();?>
        </div>
        <div class="col-md-2">
                <?= $form->field($model,'lessbusy')->checkbox();?>           
        </div>
    </div>   
    <div class="row">
        <div class="col-md-12">
            <h3>Parking History</h3>
        </div>
        <div class="col-md-12">
        <?php 
            $history = Json::decode($model->history);
            if(isset($history)){
                foreach($histroy as $permig=>$cnt){
                   echo $permit. ":".$cnt."<br>";
                }
            }else{ 
                echo "No Parking History.<br>";
            }
        ?>
        </div>
    </div>     
    <div class="col-md-4">
        <div class="form-group pull-right">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'setting-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>