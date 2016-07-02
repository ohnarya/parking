<?php
namespace frontend\models\parking;

use yii\base\Model;
use frontend\models\parking\ParkingLot;

class ParkingLotResult extends ParkingLot
{
    public $category;
    public $destination;
    public $distance;    
    public $time;

    public function rules()
    {
        return [
            [['category','destination','distance','time'], 'required'],
        ];
    }
}
?>