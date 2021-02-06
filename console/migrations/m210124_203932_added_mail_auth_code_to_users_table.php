<?php

use yii\db\Migration;

/**
 * Class m210124_203932_added_mail_auth_code_to_users_table
 */
class m210124_203932_added_mail_auth_code_to_users_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%users}}', 'mail_auth_code', $this->integer()->after('id'));

    }

    public function down()
    {
        $this->dropColumn('{{%users}}', 'mail_auth_code');
    }
}
