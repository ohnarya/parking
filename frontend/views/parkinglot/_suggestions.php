<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-12">
    <div class="lot-suggestion  col-md-11" place=<?=$model['lot']['place']?> dest=<?=$model['lot']['destination']?>> 
        <div class="lot-title">
            <?php if( $model['category'] === 'closest' ){
                echo '<i class="fa fa-font-awesome" aria-hidden="true"></i> Closest Distance';
    
            }else if($model['category'] === 'mostoften') {
                echo '<i class="fa fa-users" aria-hidden="true"></i> Most Often Visited';
                
            }else if($model['category'] === 'preferable') {
                echo '<i class="fa fa-heart" aria-hidden="true"></i> Most Preferable';
            }
            
            ?>
        </div>  
        <br>
        
        <div class="lot col-md-2"><?=$model['lot']['permit']?></div>
        <div class="lot col-md-6"><?=$model['lot']['address']?></div>
        <div class="lot col-md-2">
            <i class="fa fa-bolt" aria-hidden="true"></i> <?=$model['lot']['distance']['text']?></div>
        <div class="lot col-md-2">
            <i class="fa fa-clock-o" aria-hidden="true"></i> <?=$model['lot']['time']['text']?></div> 
        

        <div class="direction_container col-md-12  no-padding no-margin " style="display:none">
            <div id="directionsPanel" class="col-md-offset-4 col-md-8pull-right"></div>      
        </div>
        
    </div>    
    <div class="col-md-1">
        <?php
            echo Html::button('select',
                         ['id'=>'store-history', 'class'=>'btn btn-danger btn-xs',
                         'onclick'=>'storeHistory()'
                         ] 
                    );  
        ?>
    </div> 
<br><br><br><br><br>
</div>




