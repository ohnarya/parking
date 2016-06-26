<?php
namespace frontend\views\setting;

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\assets\SearchAsset;
use frontend\models\search\SearchForm;

?>

<?php SearchAsset::register($this); ?>
<?php
$form = ActiveForm::begin([
    'id' => 'search-form',
    'action' => Url::to(['search/index']),
    'method' =>'POST',
    'type' => ActiveForm::TYPE_INLINE,
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

<div class="col-md-6 col-md-offset-6" id="search-result">
	<span id="search-loading">
	    <?php if(isset($data['result']) && $data['result'] == 0){ ?>
		    <?= $data['errors']?>
		<?php } else if(isset($data['result']) && $data['result'] == 1) { ?>
	        <?php echo("<strong>Results for '".$model->query."' from Amazon.com.</strong><br><br>");?>
		    <?= $data['content']?>
		<?php } ?>
	</span>
</div>

