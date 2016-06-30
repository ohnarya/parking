<?php
namespace frontend\models\parking;

/**
 * Signup form
 */
class ParkinglotSearchForm extends ParkingLot
{
    public $permit;
    public $destination;
    public $date;
    public $time;
    public $easyparking;
    public $easyexitg;  
    public $myhistory;  
    
    public function rules()
    {
        return [
            [['permit','destination','date','time'], 'trim'],
            [['destination','date','time'], 'required'],
            [['easyparking','easyexit','myhistory'], 'safe'],
        ];
    }
}
?>