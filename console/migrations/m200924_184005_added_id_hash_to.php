<?php

use yii\db\Migration;

/**
 * Class m200924_184005_added_id_hash_to
 */
class m200924_184005_added_id_hash_to extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_orders}}', 'id_hash', $this->string()->after('id'));
    }

    public function down()
    {

        $this->dropColumn('{{%shop_orders}}', 'id_hash');
        return false;
    }
}
