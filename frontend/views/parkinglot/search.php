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
use yii\bootstrap\Modal;

$this->title='Search Parking Lot';
?>
<div  class="col-md-6">
    <h1><?= Html::encode($this->title) ?></h1>
<?php
Modal::begin([
    'header' => '<h4>Parking Lot Rules and Regulations</h4>',
    'headerOptions'=>['class'=>'bg-primary'],
    'closeButton'=>[],
    'toggleButton' => ['label' => '<i class="fa fa-car" aria-hidden="true"></i> parking rules','class'=>'btn-xs btn-danger pull-right'],
    'footer'=> Html::a('close')
]);
?>

&bull;A user can use a parking lot which the use has the permit of anytime.<br>
&bull;Some parking lots are open to the public at night (17:00~8:00 next day).<br>
&bull;Some parking lots are open to the public during Summer (June,July,and August).<br>
&bull;Some parking lots are closed when the school has home-games.<br>
&nbsp;- Even to the permit holders.<br>
&bull;Some parking lots are close due to the construction.<br>

<?php

Modal::end();           
?>     
    <h4>&bull; Search Conditions</h4>
    <div class='row'>
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
        <br>
        <br>
        
    </div>
    <hr> 
    <h4>&bull; Parking Lot Preference</h4>
    <div class='row'>
        
        <div class="col-md-4">
                <?= $form->field($model, 'easyparking')->checkbox();?>             
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'easyexit')->checkbox();?>             
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'myhistory')->checkbox();?>           
        </div> 
        <br>
        <br>
        <br>
    
    </div>
    <?= Html::submitButton('Search', ['id'=>'search-button',
                          'class' => 'btn btn-primary']); ?>
                          
    <?php ActiveForm::end() ?>                                 
    
    <?php if(isset($suggestionDP)){  ?>
    
    <div class='margin-sm'>
        <h3>Search Results...</h3>    
        <div class="suggestions">
            <?= ListView::widget([
                    'dataProvider' => $suggestionDP,
                    'itemView' => '_suggestions',
                    'layout'=>'{items}',
                ]);?>
        </div>
    </div>
    <?php } ?>
</div>

<div id="googleMap" class="col-md-6 map-container" clickable="0"></div>

<?php MapAsset::register($this); ?>


  