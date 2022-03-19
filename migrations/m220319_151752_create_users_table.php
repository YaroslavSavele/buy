<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220319_151752_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'email' => $this->string(128)->notNull()->unique(),
            'password' => $this->string(255),
            'date_registration' => $this->datetime(),
            'avatar' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
