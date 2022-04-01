<?php

use yii\db\Migration;

/**
 * Class m220331_165755_insert_data_to_categories_table
 */
class m220331_165755_insert_data_to_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->batchInsert('categories', ['name'], [
         ["Дом"],
         ["Авто"],
         ["Спорт и отдых"], 
         ["Электроника"], 
         ["Одежда"], 
         ["Книги"]
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220331_165755_insert_data_to_categories_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220331_165755_insert_data_to_categories_table cannot be reverted.\n";

        return false;
    }
    */
}
