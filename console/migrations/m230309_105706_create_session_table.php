<?php

use yii\db\Migration;

class m230309_105706_create_session_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'logged' => $this->boolean(),
            'created_at' => $this->timestamp(),
            'expires' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
