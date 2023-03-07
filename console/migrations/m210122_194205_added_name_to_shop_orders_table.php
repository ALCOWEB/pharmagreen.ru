<?php

use yii\db\Migration;

/**
 * Class m210122_194205_added_name_to_shop_orders_table
 */
class m210122_194205_added_name_to_shop_orders_table extends Migration
{
    public function up()
    {   $this->dropColumn('{{%shop_orders}}', 'first_name');
        $this->dropColumn('{{%shop_orders}}', 'last_name');
        $this->addColumn('{{%shop_orders}}', 'name', $this->text()->after('statuses_json'));

    }
    public function down()
    {
        $this->dropColumn('{{%shop_orders}}', 'name');
        $this->addColumn('{{%shop_orders}}', 'first_name', $this->text()->after('statuses_json'));
        $this->addColumn('{{%shop_orders}}', 'last_name', $this->text()->after('first_name'));

    }
}
