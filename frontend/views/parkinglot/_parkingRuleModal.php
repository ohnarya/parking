<?php
use yii\bootstrap\Modal;
?>
<?php
Modal::begin([
    'header' => '<h4>Parking Lot Rules and Regulations</h4>',
    'headerOptions'=>['class'=>'bg-primary'],
    'closeButton'=>[],
    'toggleButton' => ['label' => '<i class="fa fa-car" aria-hidden="true"></i> parking rules','class'=>'btn-xs btn-danger'],
    'footer'=> "<button type='button' data-dismiss='modal' class='btn btn-danger pull-right margin-sm'> Close</button>"
]);
?>

&bull;A user can use a parking lot which the use has the permit of anytime.<br>
&bull;Some parking lots are open to the public at night (17:00~8:00 next day).<br>
&bull;Some parking lots are open to the public during Summer (June,July,and August).<br>
&bull;Some parking lots are closed when the school has home-games.<br>
&nbsp;- Even to the permit holders.<br>
&bull;Some parking lots are close due to the construction.<br>

<?php

Modal::end();           
?> 