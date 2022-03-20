<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%categories}}`
 */
class m220320_074807_create_offers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offers}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'img' => $this->string(255),
            'price' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->datetime(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-offers-user_id}}',
            '{{%offers}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-offers-user_id}}',
            '{{%offers}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-offers-category_id}}',
            '{{%offers}}',
            'category_id'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-offers-category_id}}',
            '{{%offers}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-offers-user_id}}',
            '{{%offers}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-offers-user_id}}',
            '{{%offers}}'
        );

        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-offers-category_id}}',
            '{{%offers}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-offers-category_id}}',
            '{{%offers}}'
        );

        $this->dropTable('{{%offers}}');
    }
}
