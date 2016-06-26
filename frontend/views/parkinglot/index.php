<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\models\parking\ParkingLot;
?>

<?php
$parkinglot = new ParkingLot();
$gridColumns = [
[
    'class' => '\kartik\grid\SerialColumn'
],
'name','lat','lng',
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
            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>',Url::to(['parkinglot/save','id'=>$model->id]));    
        }
        
        ]

],    
    ];
?>
<div  class="col-md-6">
    <div class='row margin-sm'>
        <?php
        $form = ActiveForm::begin([
            'id' => 'search-form',
            'action' => Url::to(['parkinglot/view']),
            'method' =>'GET',
            'type' => ActiveForm::TYPE_INLINE,
        ]) ?>        
        <?= Html::submitButton('Add a Parking Lot', ['id'=>'search-button',
                                  'class' => 'btn btn-primary']); ?>
    <?php ActiveForm::end() ?>                                 
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
<div id="googleMap" class="col-md-6  map-container"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  