<?php
namespace frontend\models\parking;

use yii\base\Model;
use frontend\models\parking\ParkingLot;
/**
 * Signup form
 */
class ParkingForm extends ParkingLot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','lat','lng'], 'trim'],
            [['name','lat','lng'], 'required'],
            ['name', 'string', 'min' => 3, 'max' => 20],
            [['lat','lng'],'number'],
            [['night','summer','football','construction'],'safe'],
        ];
    }
}
?>