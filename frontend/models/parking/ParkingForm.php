<?php
namespace frontend\models\parking;

use frontend\models\parking\ParkingLot;

class ParkingForm extends ParkingLot
{
    public function rules()
    {
        return [
            [['permit','lat','lng'], 'trim'],
            [['permit','lat','lng'], 'required'],
            ['permit', 'string', 'min' => 3, 'max' => 20],
            [['lat','lng'],'number'],
            [['night','summer','football','construction'],'safe'],
        ];
    }
}
?>