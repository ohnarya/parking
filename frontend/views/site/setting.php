<?php
namespace frontend\views\site;

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use frontend\models\Users;
use yii\helpers\Url;
use yii\helpers\Json;
$this->title = 'My Account';
?>  
<div class="site-signup">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1><?= Html::encode($this->title) ?></h1><br>
            <?php $form = ActiveForm::begin(['id' => 'setting-form',    
                                             'action' => Url::to(['site/settingsave']),
                                             'method' =>'POST']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>
           <hr>
           <?= $this->render("_lotinfo",['form'=>$form,'model'=>$model,'parkinglot'=>$parkinglot])?>
           <br>
             <div class= "pull-right">
                 <?= Html::submitButton('Save My Setting', ['class' => 'btn btn-primary', 'name' => 'setting-button']) ?>
            </div>         
        </div>

    </div>
    <?php ActiveForm::end(); ?>
    
    <br>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1>My Parking History</h1><br>
            <?php 
                $history = Json::decode($model->history);
    
                if(is_array($history) || is_object($history)){
                    foreach($history as $d=>$p){
                      echo "<p class='col-md-4'><i class='fa fa-check-circle' aria-hidden='true'></i> ".$d. ":</p>";
                      echo "<p class='col-md-8'>";
                            foreach($p as $n=>$cnt){
                                echo $n.": ".$cnt." time(s). <br>";
                            }
                      echo "</p>";
                    }
                }else{ 
                    echo "No Parking History.<br>";
                }
            ?>
        </div>
    </div>
    <br><br>
    <div class='row'>
        <div class="col-md-offset-3 col-md-6">
<pre class="site-helper">
&bull; Parking Lot Preferences : 
  When searching the best suggestions for the parking lot, 
  a user can give his/her preferences, such as
  
    <span class='hightlighted-word'>Easyparking</span> : a parking lot is easy to park.
    <span class='hightlighted-word'>Easyexit</span> : a parking lot is easy to exit.
    <span class='hightlighted-word'>MyHistory</span> : a parking lot that the user used the most.
    
</pre>        
        </div>        
    </div>      
</div>

