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
    <h1><?= ($model->isNewRecord)? 'Create' : 'Update' ?> <?=$this->title?> </h1>

    <div class='row'>
        <div class="col-md-4">
        <?= $form->field($model, 'name')
                 ->input('permit',['class'=>'form-control']); ?>  
        </div>
        <div class="col-md-12" id="address">
        <?= $form->field($model, 'address')
                 ->input('permit',['class'=>'form-control','readonly' => true])->hint('This field will be set an address when the map is clicked.'); ?>             
        </div>
        <div class="col-md-12" id="place">
        <?= $form->field($model, 'place')
                 ->hiddenInput(['class'=>'form-control'])->label(false); ?>  
        </div>
        <br>
    </div>    
    <div class='row'>
        <div class="col-md-12 pull-right">
        <?= Html::submitButton($model->isNewRecord?'Create':'Update', ['id'=>'destination-save-button',
                                  'class' => 'btn pull-right '.($model->isNewRecord?'btn-primary':'btn-success')]); ?>
        </div>              
    </div>
    <br><br>
    <div class='row'>
        <div class="col-md-12">
<pre class="site-helper">
When a location is clicked on the map, its <strong>address</strong> will be automatically filled.
This uses <strong>Google Map APIs - geocoder</strong>.
</pre>        
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>   
<div id="googleMap" class="col-md-6  map-container" clickable="1"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  