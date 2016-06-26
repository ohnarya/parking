<?php
namespace frontend\models\parking;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class ParkingLot extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_PARKING_LOT';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

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