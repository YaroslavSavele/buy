<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%offers}}`
 */
class m220320_080034_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'user_id' => $this->integer()->notNull(),
            'offer_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-comments-user_id}}',
            '{{%comments}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-comments-user_id}}',
            '{{%comments}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `offer_id`
        $this->createIndex(
            '{{%idx-comments-offer_id}}',
            '{{%comments}}',
            'offer_id'
        );

        // add foreign key for table `{{%offers}}`
        $this->addForeignKey(
            '{{%fk-comments-offer_id}}',
            '{{%comments}}',
            'offer_id',
            '{{%offers}}',
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
            '{{%fk-comments-user_id}}',
            '{{%comments}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-comments-user_id}}',
            '{{%comments}}'
        );

        // drops foreign key for table `{{%offers}}`
        $this->dropForeignKey(
            '{{%fk-comments-offer_id}}',
            '{{%comments}}'
        );

        // drops index for column `offer_id`
        $this->dropIndex(
            '{{%idx-comments-offer_id}}',
            '{{%comments}}'
        );

        $this->dropTable('{{%comments}}');
    }
}
