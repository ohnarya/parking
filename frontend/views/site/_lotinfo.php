<?php
use kartik\widgets\SwitchInput;
?>
<div class="col-md-12">
    <h3>My Parking Lot</h3>
</div>
<div class="col-md-12">
<?= $form->field($model, 'permit')
         ->dropdownList($parkinglot,['class'=>'form-control','prompt'=>'Select Permit..'
                                         ]); ?>        
</div>
<div class="col-md-4">
        <?= $form->field($model, 'easyparking')->checkbox();?>             
</div>
<div class="col-md-4">
        <?= $form->field($model, 'easyexit')->checkbox();?>            
</div>
<div class="col-md-4">
        <?= $form->field($model, 'myhistory')->checkbox();?>             
</div> 