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


  