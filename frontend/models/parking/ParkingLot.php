<?php
namespace frontend\models\parking;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helper\Json;

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
            [['permit','place'], 'trim'],
            [['permit','address'], 'required'],
            ['permit', 'string', 'min' => 2, 'max' => 20],
            [['night','summer','football','construction','address','easyparking','easyexit'],'safe'],
        ];
    }
    public static function getPlace($lat, $lng)
    {
        return Json::encode(['lat'=>$lat, 'lng'=>$lng]);
    }
    public static function getLatLng($place)
    {
        return Json::decode($place);
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