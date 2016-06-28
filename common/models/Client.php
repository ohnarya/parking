<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Client extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TB_CLIENT';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip','key','created_at'], 'required'],
            ['userid','safe'],
        ];
    }
}