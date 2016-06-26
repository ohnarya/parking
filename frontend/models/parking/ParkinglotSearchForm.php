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
    public $closest;
    public $popular;
    public $mostofen;
    
    public function rules()
    {
        return [
            [['permit','destination','date','time','closest','popular','mostofen'], 'trim'],
            [['destination','date','time'], 'required'],
        ];
    }
}
?>