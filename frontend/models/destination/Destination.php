<?php
namespace frontend\models\destination;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Destination extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_DESTINATION';
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
            [['name','lat','lng'], 'trim'],
            [['name','lat','lng'], 'required'],
            ['name', 'string', 'min' => 2, 'max' => 20],
            [['lat','lng'],'number'],
        ];
    }
}