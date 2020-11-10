<?php

use yii\db\Migration;

/**
 * Class m200719_225233_add_user_name_to_comments_table
 */
class m200719_225233_add_user_name_to_comments_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%blog_comments}}', 'user_name', $this->string());
    }

    public function down()
    {

        $this->dropColumn('{{%blog_comments}}', 'user_name');
        return false;
    }
}
