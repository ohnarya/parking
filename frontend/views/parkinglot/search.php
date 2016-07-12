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

$this->title='Search Parking Lot';
?>
<div  class="col-md-6">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_parkingRuleModal')?>
    
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
        <h3>Search Results </h3>    
        <p>To see <span class='hightlighted-word'>a detailed route</span>, click on suggestions. 
           To save <span class='hightlighted-word'>the current choice</span> for future usage in prerefence parking, click <?=Html::a('select','#',['class'=>'btn-xs btn-danger']) ?> button below.</p>
        <br>
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


  