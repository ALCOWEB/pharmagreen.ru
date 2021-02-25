<?php

use yii\db\Migration;

/**
 * Class m210223_213107_shop_orders_cost_canbenull
 */
class m210223_213107_shop_orders_cost_canbenull extends Migration
{
    public function up()
    {

        $this->alterColumn('{{%shop_orders}}', 'cost', $this->integer());

    }
}
