<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

$this->title='Destination Information';
?>

<?php
$form = ActiveForm::begin([
    'id' => 'view-form',
    'action' => Url::to(['destination/save','id'=>$model->id]),
    'method' =>'POST',
    'type' => ActiveForm::TYPE_VERTICAL,
]) ?> 

<div  class="col-md-6">
    <div class='row margin-sm'>
        <div class='col-md-12'>
            <h3 style='text-shadow: 2px 2px 4px'><?= ($model->isNewRecord)? 'Create' : 'Update' ?> <?=$this->title?> </h3>
            <div class="col-md-12 pull-right">
            <?= Html::submitButton($model->isNewRecord?'Create':'Update', ['id'=>'destination-save-button',
                                      'class' => 'btn pull-right '.($model->isNewRecord?'btn-primary':'btn-success')]); ?>
            </div>              
        </div>
        <hr>

        <div class="col-md-4">
        <?= $form->field($model, 'name')
                 ->input('permit',['class'=>'form-control']); ?>  
        </div>
        <div class="col-md-8" id="address">
        <?= $form->field($model, 'address')
                 ->input('permit',['class'=>'form-control']); ?>             
        </div>
        <div class="col-md-12" id="place">
        <?= $form->field($model, 'place')
                 ->hiddenInput(['class'=>'form-control'])->label(false); ?>  
        </div>
        <br>
    </div>    
</div>
<?php ActiveForm::end() ?>   
<div id="googleMap" class="col-md-6  map-container" clickable="1"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  