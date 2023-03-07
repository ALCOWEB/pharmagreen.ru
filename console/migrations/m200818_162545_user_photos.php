<?php

use yii\db\Migration;

/**
 * Class m200818_162545_user_photos
 */
class m200818_162545_user_photos extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%user_photos}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('{{%idx-user_photos-user_id}}', '{{%user_photos}}', 'user_id');
        $this->addForeignKey('{{%fk-user_photos-user_id}}', '{{%user_photos}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }
    public function down()
    {
        $this->dropTable('{{%user_photos}}');
    }
}

