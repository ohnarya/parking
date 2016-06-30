<?php
namespace frontend\models\parking;

use yii\base\Model;

class LotResult extends Model
{
    public $category;
    public $destination;
    public $permit;
    public $address;
    public $place; // json {lat:xxxx, lng:xxxx}
    public $distance;    
    public $time;

    public function rules()
    {
        return [
            [['category','permit','address','place','distance','time','destination'], 'safe'],
        ];
    }
}
?>