
<?php
use yii\web\View;
use frontend\assets\MapAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
?>

<body>
<div  class="col-md-3">
    <?php
    $form = ActiveForm::begin([
        'id' => 'search-form',
        'action' => Url::to(['parking/save']),
        'method' =>'POST',
        'type' => ActiveForm::TYPE_HORIZONTAL,
    ]) ?>
    <div class='col-md-12'>
        Type a Query  
        <?= $form->field($model, 'query')
                 ->input('query',['id'=>"search-input", 
                                  'class'=>'form-control'])->label(false); ?>                                  
        <?= Html::submitButton('search', ['id'=>'search-button',
                                          'class' => 'btn btn-primary']); ?>
    <hr>
    </div>
    
    <?php ActiveForm::end() ?>    
</div>
<div id="googleMap" class="col-md-9  map-container"></div>

<?php MapAsset::register($this); ?>
</body>
</html>


  