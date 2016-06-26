<?php
namespace frontend\views\setting;

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\assets\SearchAsset;
use frontend\models\search\SearchForm;

$this->title='Search Items from Amazon.com';
?>

<?php SearchAsset::register($this); ?>
<?php
$form = ActiveForm::begin([
    'id' => 'search-form',
    'action' => Url::to(['search/index']),
    'method' =>'POST',
    'type' => ActiveForm::TYPE_INLINE,
]) ?>
<div class='col-md-6'>
    <h3 style='text-shadow: 2px 2px 4px'>Search Items from Amazon.com..</h3>
</div>
<div class='col-md-5' style="margin-top:20px;">    
    <b>Type a Query</b>  
    <?= $form->field($model, 'query')
             ->input('query',['id'=>"search-input", 
                              'class'=>'form-control'])->label(false); ?>                                  
    <?= Html::submitButton('search', ['id'=>'search-button',
                                      'class' => 'btn btn-primary']); ?>
</div>


<?php ActiveForm::end() ?>

<div class="col-md-12" id="search-result">
<hr>
	<span id="search-loading">
	    <?php if(isset($data['result']) && $data['result'] == 0){ ?>
		    <?= $data['errors']?>
		<?php } else if(isset($data['result']) && $data['result'] == 1) { ?>
	        <?php echo("<strong>Results for '".$model->query."' from Amazon.com.</strong><br><br>");?>
		    <?= $data['content']?>
		<?php } ?>
	</span>
</div>

