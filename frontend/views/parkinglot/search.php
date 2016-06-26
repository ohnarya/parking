<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use kartik\widgets\SwitchInput;

use frontend\models\parking\ParkinglotSearchForm;

date_default_timezone_set('America/Chicago'); 

$this->title='Search Parking Lot';

$model=new ParkinglotSearchForm();
$model->date = date('Y/m/d');
$model->time = date('H:i:s');
echo($model->time);

?>
<div class='col-md-12'>
    <h3 style='text-shadow: 2px 2px 4px'>Search Parking Lot...</h3>
</div>
<div  class="col-md-6">
    <div class='row margin-sm'>
        <?php
        $form = ActiveForm::begin([
            'id' => 'search-form',
            'action' => Url::to(['parkinglot/search']),
            'method' =>'POST',
            'type' => ActiveForm::TYPE_VERTICAL,
        ]) ?> 
        <div class="col-md-6">
            <?= $form->field($model, 'permit')
                     ->dropdownList($parkinglot,['class'=>'form-control','prompt'=>'Select Permit..']); ?>  
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'destination')
                     ->dropdownList($destination,['class'=>'form-control','prompt'=>'Select Destination..']); ?>  
        </div>        
        <div class="col-md-6">
            <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                                                                                    'type'   => DatePicker::TYPE_COMPONENT_APPEND,
                                                                                    'pluginOptions' => [
                                                                                        'autoclose' => true,
                                                                                        'format'    => 'yyyy/mm/dd',
                                                                                        'todayHighlight' => true
                                                                                    ]
                                                                                ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'time')
                     ->widget(TimePicker::classname(), [ 
                                                         'pluginOptions'=>['showMeridian'=>false]]);?>
        </div>   
        
        <div class='padding-sm-horizontal'>
            <br>
            <p>&bull; Parking Lot Preference </p>
        </div>
        
        <div class="col-md-4">
            <?= $form->field($model, 'closest')
                     ->widget(SwitchInput::classname(),[ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>
        
        <div class="col-md-4">
            <?= $form->field($model, 'popular')
                     ->widget(SwitchInput::classname(),[ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>           
        <div class="col-md-4">
            <?= $form->field($model, 'mostofen')
                     ->widget(SwitchInput::classname(),[ 'pluginOptions'=>[
                                                      'handleWidth'=>20,
                                                      'onText'=>'Yes',
                                                      'offText'=>'No'
                                                    ]]); ?>
        </div>           
        
        <div class="pull-right">
            <?= Html::submitButton('Search', ['id'=>'search-button',
                                      'class' => 'btn btn-primary pull-right']); ?>
        </div>
        
        
        
        
    <?php ActiveForm::end() ?>                                 
    </div>
    
    <div class='row margin-sm' style='display:none'>
        <h3 style='text-shadow: 2px 2px 4px'>Search Results...</h3>    
    </div>
</div>
<div id="googleMap" class="col-md-6  map-container" clickable="0"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  