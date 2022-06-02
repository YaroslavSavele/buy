<?php
namespace app\models;

use yii\base\Model;
use Kreait\Firebase\Factory;


class Chat extends Model
{
    public $database;
    protected $dbname = 'chat';
    public $text;
    public $key;

    public function __construct()
    {
        $firebase = (new Factory())
            ->withServiceAccount('../config/buybase-6aa76-firebase-adminsdk-43fpz-b81badde6b.json')
            ->withDatabaseUri('https://buybase-6aa76-default-rtdb.firebaseio.com');
        $this->database = $firebase->createDatabase();
    }

    public function get($chat_id)
    {
        return $this->database->getReference($this->dbname . '/' . $chat_id)->getValue();
    }

    public function insert(array $data)
    {
        if (empty($data) || !isset($data)) {
            return false;
        }

        foreach ($data as $key => $value) {
                $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }
        return true;
    }

    public function write(array $data, $chat_id)
    {
        if (empty($data) || !isset($data)) {
            return false;
        }

        $this->database->getReference($this->dbname . '/' . $chat_id)->push($data);

        return true;
    }

    public function delete(int $userID)
    {
        if (empty($userID) || !isset($userID)) {
            return false;
        }
        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)) {
            $this->database->getReference($this->dbname)->getChild($userID)->remove();
            return true;
        } else {
               return false;
        }
    }

    public function rules()
    {
        return [
            ['text', 'required'],
            [['text'], 'string', 'min' => 2, 'max' => 500,
                'tooShort' => "Не менее {min} символов", 'tooLong' => 'Не более {max} символов'],
            ['key', 'string'],
        ];
    }
}
