<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

?>

<?php
$form = ActiveForm::begin([
    'id' => 'view-form',
    'action' => Url::to(['parkinglot/save','id'=>$model->id]),
    'method' =>'POST',
    'type' => ActiveForm::TYPE_VERTICAL,
]) ?> 

<div  class="col-md-6">
    <div class='row margin-sm'>
        <div class='padding-sm-horizontal'>
            <h3><?= ($model->isNewRecord)? 'Create' : 'Update' ?> Parking Lot Information </h3>
        </div>
        <hr>
        <div class='padding-sm-horizontal'>
            <p>&bull; Parking Lot Information </p>
        </div>
        <!--<div class="col-md-6">-->
        <?php // $form->field($model, 'symbol')->input('symbol',['class'=>'form-control']); ?>       
        <!--</div>-->
        <div class="col-md-12">
        <?= $form->field($model, 'name')
                 ->input('name',['class'=>'form-control']); ?>  
        </div>
        <div class="col-md-6">
        <?= $form->field($model, 'lat')
                 ->input('lat',['class'=>'form-control']); ?>  
        </div>
        <div class="col-md-6">
        <?= $form->field($model, 'lng')
                 ->input('lng',['class'=>'form-control']); ?>  
        </div>
        <div class='padding-sm-horizontal'>
            <p>&bull; Parking Lot Status </p>
        </div>
        <div class="col-md-6">
        <?= $form->field($model, 'night')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        <div class="col-md-6">         
        <?= $form->field($model, 'summer')
                 ->widget(SwitchInput::classname(),[ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        <div class="col-md-6">
        <?= $form->field($model, 'football')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        <div class="col-md-6">
        <?= $form->field($model, 'construction')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>              
        </div>
        <br>
        <div class="pull-right">
        <?= Html::submitButton($model->isNewRecord?'Create':'Update', ['id'=>'parkinglot-save-button',
                                  'class' => 'btn pull-right '.($model->isNewRecord?'btn-primary':'btn-success')]); ?>
        </div>                      
    </div>    
</div>
<?php ActiveForm::end() ?>   
<div id="googleMap" class="col-md-6  map-container"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  