<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\models\parking\ParkingLot;

$this->title='Manage Parking Lot';
?>

<?php
$parkinglot = new ParkingLot();
$gridColumns = [
[
    'class' => '\kartik\grid\SerialColumn'
],
'permit','lat','lng',
[
    'class'=>'kartik\grid\BooleanColumn',
    'attribute'=>'night', 
    'vAlign'=>'middle'
],    
[
    'class'=>'kartik\grid\BooleanColumn',
    'attribute'=>'summer', 
    'vAlign'=>'middle'
],
[
    'class'=>'kartik\grid\BooleanColumn',
    'attribute'=>'football', 
    'vAlign'=>'middle'
],
[
    'class'=>'kartik\grid\BooleanColumn',
    'attribute'=>'construction', 
    'vAlign'=>'middle'
],
[
    'class'=>'kartik\grid\ActionColumn',
    'template' => '{view} {update} {delete}',
    'buttons' => [
        'view' => function($url, $model){
            return Html::a('<i class="fa fa-map-pin" aria-hidden="true"></i>','#',['class'=>'show-map', 'lat'=>$model->lat, 'lng'=>$model->lng]);            
        },
        'update'=> function($url, $model){
            return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',Url::to(['parkinglot/view','id'=>$model->id]));
        },
        'delete'=> function($url, $model){
            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>',Url::to(['parkinglot/delete','id'=>$model->id]));    
        }
        
        ]

],    
];
?>
<div class='col-md-12'>
    <h3 style='text-shadow: 2px 2px 4px'>Parking Lot Information...</h3>
</div>
<div  class="col-md-6">
    <div class='row margin-sm'>
        <?= Html::a('Add a Parking Lot', [Url::to(['parkinglot/view'])], 
                                  ['id'   =>'search-button',
                                   'class'=>'btn btn-primary pull-right']); ?>
         
    </div>    
    <div class='row margin-sm'>
        <?php
            echo GridView::widget([
                'dataProvider'=> $dataProvider,
                // 'filterModel' => $parkinglot,
                'columns' => $gridColumns,
                'responsive'=>true,
                'hover'=>true
            ]);
        ?>
    </div>

</div>
<div id="googleMap" class="col-md-6  map-container" clickable="0"></div>

<?php MapAsset::register($this); ?>


  