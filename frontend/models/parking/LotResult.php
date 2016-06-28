<?php
namespace frontend\models\parking;

use yii\base\Model;

class LotResult extends Model
{
    public $permit;    
    public $address; 
    public $lat;    
    public $lng;    
    public $distance;    
    public $time;

    public function rules()
    {
        return [
            [['permit','address','lat','lng','type','value'], 'safe'],
        ];
    }
}
?>