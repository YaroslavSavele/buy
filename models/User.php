<?php

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property string|null $date_registration
 * @property string|null $avatar
 * @property int $is_moderator
 *
 * @property Comments[] $comments
 * @property Offers[] $offers
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password_repeat;
    public $imageFile;
    
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_repeat'], 'required', 'message' => 'Обязательное поле'],
            [['date_registration', 'is_moderator', 'imageFile'], 'safe'],
            [['email'], 'email', 'message' => 'Некорректный email'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
            [['is_moderator'], 'integer'],
            [['name', 'email'], 'string', 'max' => 128],
            ['name', 'match', 'pattern' => "/[а-яА-ЯЁёa-zA-Z\s]/",  'message' => 'Имя не должно содержать цифр и специальных символов'],
            [['password', 'password_repeat'], 'string',  'length' => [6, 128], 'message' => 'Пароль должен быть не меньше 6 символов'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
            [['email'], 'unique', 'message' => 'Пользователь с таким имейлом уже зарегестрирован'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'date_registration' => 'Date Registration',
            'avatar' => 'Avatar',
            'is_moderator' => 'Is Moderator',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Offers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offer::className(), ['user_id' => 'id']);
    }

    public function upload()
    {
        if ($this->imageFile) {
            $this->avatar ='/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
        }
    }
}
