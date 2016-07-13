<?php
namespace frontend\views\parking;

use yii\web\View;
use frontend\assets\MapAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\models\destination\Destination;

$this->title='Manage Destinations';
?>

<?php
$info = 'These are buildings on Texas A&M Campus on College Station, TX';
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
<div  class="col-md-6 col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1><br>
  
    <div class='row'>
        <div class="col-md-12">
            <?php
                echo GridView::widget([
                    'dataProvider'=> $dataProvider,
                    'panel'=>[
                        'type'=>GridView::TYPE_PRIMARY,
                        'heading'=>false,
                        'footer'=>false,
                        'after'=>'<i class="fa fa-check-circle" aria-hidden="true"></i> '.$info
                    ],
                    'toolbar'=> [],
                    'columns' => $gridColumns,
                    'responsive'=>true,
                    'hover'=>true
                ]);
            ?>
        </div>
    </div>
    <div class='row'>
        <div class="col-md-12 pull-right">
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



  