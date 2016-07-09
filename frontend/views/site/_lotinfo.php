<?php
use kartik\widgets\SwitchInput;
?>

<h4>&bull; My Parking Permit</h4>


<?= $form->field($model, 'permit')
         ->dropdownList($parkinglot,['class'=>'form-control','prompt'=>'Select Permit..'
                                         ]); ?>        

<br>
<h4>&bull; My Parking Preferences</h4>
<div class="col-md-4">
        <?= $form->field($model, 'easyparking')->checkbox();?>             
</div>
<div class="col-md-4">
        <?= $form->field($model, 'easyexit')->checkbox();?>            
</div>
<div class="col-md-4">
        <?= $form->field($model, 'myhistory')->checkbox();?>             
</div> 
