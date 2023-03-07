<?php

use yii\db\Migration;

/**
 * Class m220605_070026_change_weight_in_products_table
 */
class m220605_070026_change_weight_in_products_table extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%shop_products}}', 'weight', $this->float(2)->notNull());
    }
    public function down()
    {
        $this->alterColumn('{{%shop_products}}', 'weight', $this->integer()->notNull());
    }
}
