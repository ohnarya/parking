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
            [['permit','lat','lng'], 'trim'],
            [['permit','lat','lng'], 'required'],
            ['permit', 'string', 'min' => 3, 'max' => 20],
            [['lat','lng'],'number'],
            [['night','summer','football','construction'],'safe'],
        ];
    }
}
?>