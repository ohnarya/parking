<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<br>
<div class="lot-sugesstion row"  place=<?=$model['lot']['place']?>>
    <div class="lot-title col-md-12">
        <?php if( $model['category'] === 'closest' ){
            echo '<i class="fa fa-font-awesome" aria-hidden="true"></i> Closest Distance';

        }else if($model['category'] === 'mostoften') {
            echo '<i class="fa fa-users" aria-hidden="true"></i> Most Often Visited';
            
        }else if($model['category'] === 'preferable') {
            echo '<i class="fa fa-users" aria-hidden="true"></i> Most Preferable';
        }
        
        ?>

        <?php
        echo Html::button('select',
                         ['id'=>'select-lot-btn', 'class'=>'btn btn-danger btn-xs',
                         'onclick'=>'storeHistory('.$model['permit'].')'
                         ] 
                    );  
        ?>
    </div>
    <br>
    <br>
    <div class="lot col-md-4 pull-left"><?=$model['lot']['permit']?></div>
    <div class="lot col-md-4">
        <i class="fa fa-bolt" aria-hidden="true"></i> <?=$model['lot']['distance']['text']?></div>
    <div class="lot col-md-4">
        <i class="fa fa-clock-o" aria-hidden="true"></i> <?=$model['lot']['time']['text']?></div> 
    <div class="lot col-md-12"><?=$model['lot']['address']?></div>
     
    <br>
    <br>
    <br>
</div>



