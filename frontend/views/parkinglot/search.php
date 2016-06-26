<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\models\parking\ParkingLot;

$this->title='Search Parking Lot';

?>

<?php
$model = new ParkingLot();
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
            'type' => ActiveForm::TYPE_HORIZONTAL,
        ]) ?> 

        <div class="col-md-12">
            <?= $form->field($model, 'permit')
                     ->dropdownList($parkinglot,['class'=>'form-control','prompt'=>'Select Category']); ?>  
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


  