<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Chat extends Model
{
    public $database;
    protected $dbname = 'chat';
    public $text;

    public function __construct(){
        //$acc = ServiceAccount::fromJsonFile(__DIR__ . '/buybase-6aa76-firebase-adminsdk-43fpz-b81badde6b.json');
        $firebase = (new Factory)->withServiceAccount(__DIR__ . '/buybase-6aa76-firebase-adminsdk-43fpz-b81badde6b.json');
        $this->database = $firebase->createDatabase();
    }
    public function get(int $userID = NULL){    
        if (empty($userID) || !isset($userID)) { return FALSE; }
        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
            return $this->database->getReference($this->dbname)->getChild($userID)->getValue();
        } else {
            return FALSE;
        }
    }
    public function insert(array $data) {
        if (empty($data) || !isset($data)) { return FALSE; }
        foreach ($data as $key => $value){
            $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }
        return TRUE;
    }
    public function delete(int $userID) {
        if (empty($userID) || !isset($userID)) { return FALSE; }
        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
            $this->database->getReference($this->dbname)->getChild($userID)->remove();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function rules()
    {
        return [
            [['text'], 'string', 'min' => 3, 'max' => 500, 'tooShort' => "Не менее {min} символов", 'tooLong' => 'Не более {max} символов'],
        ];
    }
}