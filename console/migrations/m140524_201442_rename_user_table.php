<?php

use yii\db\Migration;

/**
 * Class m201016_125701_rename_user_table
 */
class m140524_201442_rename_user_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }
    public function down()
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}
