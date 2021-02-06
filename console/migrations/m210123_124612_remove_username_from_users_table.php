<?php

use yii\db\Migration;

/**
 * Class m210123_124612_remove_username_from_users_table
 */
class m210123_124612_remove_username_from_users_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%users}}', 'username');

    }

    public function down()
    {
        $this->addColumn('{{%users}}', 'username', $this->string()->unique()->after('id'));
    }
}
