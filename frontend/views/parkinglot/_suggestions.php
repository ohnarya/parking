<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<br>
<div class="lot-sugesstion row"  lat=<?=$model['lot']['lat']?> lng=<?=$model['lot']['lng']?>>
    <div class="lot-title col-md-10">
        <?php if( $model['category'] == 'closest' ){
            echo '<i class="fa fa-font-awesome" aria-hidden="true"></i> Closest Distance';

        }else if($model['category'] == 'shortest') {
            echo '<i class="fa fa-rocket" aria-hidden="true"></i> Shortest Duration';
        }
        ?>
    </div>
    <div class="lot-title col-md-1">
        <?php
        echo Html::button('select',
                         ['id'=>'select-lot-btn', 'class'=>'btn btn-danger btn-xs',
                         'onclick'=>'storeHistory('.$model['permit'].')'
                         ] 
                    );  
        ?>
    </div>
    <br>
    <div class="lot col-md-4 "><?=$model['lot']['permit']?></div>
    <div class="lot col-md-4 ">
        <i class="fa fa-bolt" aria-hidden="true"></i> <?=$model['lot']['distance']['text']?></div>
    <div class="lot col-md-4 ">
        <i class="fa fa-clock-o" aria-hidden="true"></i> <?=$model['lot']['time']['text']?></div> 
    <div class="lot col-md-12"><?=$model['lot']['address']?></div>
     
    <br>
    <br>
    <br>
</div>



