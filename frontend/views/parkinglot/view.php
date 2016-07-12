<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use yii\bootstrap\Modal;

$this->title = 'Parking Lot Information';
?>

<?php
$form = ActiveForm::begin([
    'id' => 'view-form',
    'action' => Url::to(['parkinglot/save','id'=>$model->id]),
    'method' =>'POST',
    'type' => ActiveForm::TYPE_VERTICAL,
]) ?> 

<div  class="col-md-6">
    <h1><?= ($model->isNewRecord)? 'Create' : 'Update' ?> <?=$this->title?> </h1><br>

    <div class='row'>
        <div class="col-md-12">
            <h4>&bull; Parking Lot Information </h4> 
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'permit')
                 ->input('permit',['class'=>'form-control']); ?>  
        </div>
        <div class="col-md-9" id="address">
        <?= $form->field($model, 'address')
                 ->input('address',['class'=>'form-control','readonly' => true])->hint('This field will be set  an address when the map is clicked.'); ?>  
        </div>
        <div id="place">
        <?= $form->field($model, 'place')
                 ->hiddenInput(['class'=>'form-control'])->label(false); ?>  
        </div>
    </div>
        
    <div class='row'>        
        <div class="col-md-12">
            <h4>&bull; Parking Lot Status </h4>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'night')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        <div class="col-md-3">         
        <?= $form->field($model, 'summer')
                 ->widget(SwitchInput::classname(),[ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'football')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'construction')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>              
        </div>
    </div>
    <br>
    <div class='row'>
        <div class='col-md-12'>
            <h4>&bull; Parking Lot Preference </h4>
        </div>    
        <div class="col-md-3">
        <?= $form->field($model, 'easyparking')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'easyexit')
                 ->widget(SwitchInput::classname(), [ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>              
        </div>        
        <div class="col-md-12">
        <?= Html::submitButton($model->isNewRecord?'Create':'Update', ['id'=>'parkinglot-save-button',
                                  'class' => 'btn pull-right '.($model->isNewRecord?'btn-primary':'btn-success')]); ?>
        </div>                      
    </div>   
    <br><br>
    <div class='row'>
        <div class='col-md-12'>
            <?= $this->render('_parkingRuleModal')?> 
        </div>
    </div>
    <div class='row'>
        <div class="col-md-12">
<pre class="site-helper">
&bull; Parking Lot Status :    
  <span class='hightlighted-word'>Night</span> : available parking lots from 17:00 to 8:00 next day.
  <span class='hightlighted-word'>Summer</span> : availiable parking lots in June, July, and August.
  <span class='hightlighted-word'>Football</span> : unavailable parking lots when home-games hold.
  <span class='hightlighted-word'>Construction</span> : unavailable parking lotsdue to construction.

&bull; Parking Lot Preferences :    
  <span class='hightlighted-word'>Easyparking</span> : a parking lot is easy to park.
  <span class='hightlighted-word'>Easyexit</span> : a parking lot is easy to exit.
    
&bull; When a location is clicked on the map, its <strong>address</strong> will be filled.
  This uses <span class='hightlighted-word'>Google Map APIs - geocoder</span>.
</pre>        
        </div>
    </div>    
</div>
<?php ActiveForm::end() ?>   
<div id="googleMap" class="col-md-6  map-container" clickable="1"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  