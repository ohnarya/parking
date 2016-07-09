<?php
namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Users extends ActiveRecord 
{
    public static function tableName()
    {
        return 'TB_USER';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username','email'],'required'],
            [['easyparking','easyexit','myhistory', 'permit'],'safe'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
        ];
    }
}