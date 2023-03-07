<?php

use yii\db\Migration;

/**
 * Class m210223_213345_shop_orders_cost_notnull_delyverycost_null
 */
class m210223_213345_shop_orders_cost_notnull_delyverycost_null extends Migration
{
    public function up()
    {

        $this->alterColumn('{{%shop_orders}}', 'cost', $this->integer()->notNull());
        $this->alterColumn('{{%shop_orders}}', 'delivery_cost', $this->integer());

    }
}
