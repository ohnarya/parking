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
    public $result;   // address , lat, lng, time, distance
    
    public function rules()
    {
        return [
            [['permit','destination','date','time'], 'trim'],
            [['destination','date','time'], 'required'],
            ['result','safe']
        ];
    }
}
?>