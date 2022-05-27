<?php
namespace app\models;


use yii\base\Model;

class ChatKey extends Model
{
    public $key;

    public function rules()
    {
        return [
            ['key', 'string']
        ];
    }
    
}