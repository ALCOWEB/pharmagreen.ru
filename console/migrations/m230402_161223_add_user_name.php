<?php

use yii\db\Migration;

/**
 * Class m230402_161223_add_user_name
 */
class m230402_161223_add_user_name extends Migration
{
    public function up()
    {
        $this->addColumn('{{%users}}', 'username', $this->string()->unique()->notNull()->after('id'));

    }

    public function down()
    {
        $this->dropColumn('{{%users}}', 'username');

    }
}
