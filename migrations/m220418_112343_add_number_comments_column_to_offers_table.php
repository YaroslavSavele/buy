<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%offers}}`.
 */
class m220418_112343_add_number_comments_column_to_offers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%offers}}', 'number_comments', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%offers}}', 'number_comments_');
    }
}
