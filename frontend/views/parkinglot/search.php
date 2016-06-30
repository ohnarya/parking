<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use kartik\widgets\SwitchInput;

use frontend\models\parking\ParkinglotSearchForm;

date_default_timezone_set('America/Chicago'); 

$this->title='Search Parking Lot';

$model->date = date('Y/m/d');
$model->time = date('H:i:s');

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
                     ->dropdownList($parkarray,['class'=>'form-control','prompt'=>'Select Permit..']); ?>  
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'destination')
                     ->dropdownList($destarray,['id'=>'destination','class'=>'form-control','prompt'=>'Select Destination..']); ?>  
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

        <div class="col-md-12 pull-right">
            <?= Html::submitButton('Search', ['id'=>'search-button',
                                      'class' => 'btn btn-primary pull-right']); ?>
        </div>
  
    <?php ActiveForm::end() ?>                                 
    </div>
    <?php if(isset($suggestionDP)){  ?>
    
    <div class='row margin-sm'>
        <h3 style='text-shadow: 2px 2px 4px'>Search Results...</h3>    
        <div class="suggestions col-md-12">
            <?= ListView::widget([
                    'dataProvider' => $suggestionDP,
                    'itemView' => '_suggestions',
                    'layout'=>'{items}',
                ]);?>
        </div>
    </div>
    <?php } ?>
</div>
<div id="googleMap" class="col-md-6  map-container" clickable="0"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  