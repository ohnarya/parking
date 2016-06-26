<?php
namespace frontend\models\search;

use yii\base\Model;
/**
 * Signup form
 */
class SearchForm extends Model
{
    public $query;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['query', 'trim'],
            ['query', 'required'],
            ['query', 'string', 'min' => 3, 'max' => 20],
        ];
    }
}
?>