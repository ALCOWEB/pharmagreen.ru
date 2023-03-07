<?php

use yii\db\Migration;

/**
 * Class m230307_122700_add_username_to_user_table
 */
class m230307_122700_add_username_to_user_table extends Migration
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
