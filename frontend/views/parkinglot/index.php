<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\models\parking\ParkingLot;
use yii\bootstrap\Modal;
$this->title='Manage Parking Lots';
?>

<?php
$parkinglot = new ParkingLot();
$gridColumns = [
[
    'class' => '\kartik\grid\SerialColumn'
],
'permit','address',
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
            return Html::a('<i class="fa fa-map-pin" aria-hidden="true"></i>','#',['class'=>'show-map', 'place'=>$model->place]);            
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
<div  class="col-md-6 col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_parkingRuleModal');?>
    <br>
  
    <div class='row'>
        <div class="col-md-12">
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
    <div class='row'>
        <div class="col-md-12">
            
        <?= Html::a('Add a Parking Lot', Url::to(['parkinglot/view']), 
                                  ['id'   =>'search-button',
                                   'class'=>'btn btn-primary pull-right']); ?>
        
        </div> 
    </div> 
    <br><br>
    <div class='row'>
        <div class="col-md-12">
<pre class="site-helper">
<strong><i class="fa fa-map-pin" aria-hidden="true"></i></strong> : <span class='hightlighted-word'>points</span> to the location on the map.
<strong><i class="fa fa-pencil" aria-hidden="true"></i></strong> : <span class='hightlighted-word'>shows</span> detailed information of the selected destination.
<strong><i class="fa fa-trash" aria-hidden="true"></i></strong> : <span class='hightlighted-word'>deletes</span> the destination.
</pre>        
        </div>
    </div>    
</div>
<div id="googleMap" class="col-md-6  map-container" clickable="0"></div>

<?php MapAsset::register($this); ?>


  