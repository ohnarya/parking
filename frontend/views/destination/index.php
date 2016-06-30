<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\models\destination\Destination;

$this->title='Manage Destination';
?>

<?php
$parkinglot = new Destination();
$gridColumns = [
[
    'class' => '\kartik\grid\SerialColumn'
],
'name','address',
[
    'class'=>'kartik\grid\ActionColumn',
    'template' => '{view} {update} {delete}',
    'buttons' => [
        'view' => function($url, $model){
            return Html::a('<i class="fa fa-map-pin" aria-hidden="true"></i>','#',['class'=>'show-map', 'place'=>$model->place]);            
        },
        'update'=> function($url, $model){
            return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',Url::to(['destination/view','id'=>$model->id]));
        },
        'delete'=> function($url, $model){
            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>',Url::to(['destination/delete','id'=>$model->id]));    
        }
        
        ]

],    
    ];
?>
<div class='col-md-12'>
    <h3 style='text-shadow: 2px 2px 4px'><?=$this->title?>...</h3>
</div>
<div  class="col-md-6">
    <div class='row margin-sm'>
        <?php
        $form = ActiveForm::begin([
            'id' => 'destination-search-form',
            'action' => Url::to(['destination/view']),
            'method' =>'POST',
            'type' => ActiveForm::TYPE_INLINE,
        ]) ?>        
        <?= Html::submitButton('Add a Destination', ['id'=>'search-button',
                                  'class' => 'btn btn-primary pull-right']); ?>
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
<div id="googleMap" class="col-md-6  map-container" clickable="0"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  