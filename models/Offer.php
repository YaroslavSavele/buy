<?php

namespace app\models;

use Yii;
use app\models\Category;

/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property string $title
 * @property string|null $img
 * @property int $price
 * @property int $type
 * @property string $description
 * @property string|null $created_at
 * @property int $user_id
 * @property int $category_id
 *
 * @property Categories $category
 * @property Comments[] $comments
 * @property Users $user
 */
class Offer extends \yii\db\ActiveRecord
{
   public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price', 'type', 'description', 'category_id'], 'required', 'message' => 'Обязательное поле'],
            [['price', 'type', 'user_id', 'category_id'], 'integer'],
            [['price'], 'number', 'min' => 100, 'tooSmall' => 'Не менее {min} рублей'],
            [['description'], 'string', 'min' => 50, 'max' => 1000, 'tooShort' => "Не менее {min} символов", 'tooLong' => 'Не более {max} символов'],
            [['created_at', 'img', 'title', 'price', 'type', 'description', 'user_id', 'category_id'], 'safe'],
            [['title'], 'string', 'min' => 10, 'max' => 100, 'tooShort' => "Не менее {min} символов", 'tooLong' => 'Не более {max} символов'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
            [['img'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'img' => 'Img',
            'price' => 'Price',
            'type' => 'Type',
            'description' => 'Описание',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['offer_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function upload()
    {
        if ($this->imageFile) {
            $this->img ='uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
         }
    }
}
