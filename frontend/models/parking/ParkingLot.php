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
    public static function getNight()
    {
        return ParkingLot::find()->select('permit')->where(['night'=>true,'active'=>true])->asArray()->all();
    }
    public static function getConstruction()
    {
        return ParkingLot::find()->select('permit')->where(['construction'=>true,'active'=>true])->column();    
    }
    public static function getFootball()
    {
        return ParkingLot::find()->select('permit')->where(['football'=>true,'active'=>true])->column();    
    }
    public static function getSummer()
    {
        return ParkingLot::find()->select('permit')->where(['summer'=>true,'active'=>true])->asArray()->all();    
    }    
}