<?php
namespace frontend\models\parking;

use yii\base\Model;

/**
 * Signup form
 */
class ParkinglotSearchForm extends Model
{
    public $permit;
    public $destination;
    public $date;
    public $time;
    
    public function rules()
    {
        return [
            [['permit','destination','date','time'], 'trim'],
            [['destination','date','time'], 'required'],
        ];
    }
}
?>