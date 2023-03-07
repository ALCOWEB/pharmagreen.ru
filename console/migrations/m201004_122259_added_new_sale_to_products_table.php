<?php

use yii\db\Migration;

/**
 * Class m201004_122259_added_new_sale_to_products_table
 */
class m201004_122259_added_new_sale_to_products_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'new', $this->integer()->after('status'));
        $this->addColumn('{{%shop_products}}', 'sale', $this->integer()->after('new'));


    }
    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'new');
        $this->dropColumn('{{%shop_products}}', 'sale');
    }
}
