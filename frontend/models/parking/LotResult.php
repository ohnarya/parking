<?php
namespace frontend\models\parking;

use yii\base\Model;

class LotResult extends Model
{
    public $category;
    public $permit;    
    public $address; 
    public $lat;    
    public $lng;
    public $distance;    
    public $time;

    public function rules()
    {
        return [
            [['category','permit','address','lat','lng','distance','time'], 'safe'],
        ];
    }
}
?>