<?php

use yii\db\Migration;

/**
 * Class m210223_142234_shop_delivery_methods_remove_cost_notnull
 */
class m210223_142234_shop_delivery_methods_remove_cost_notnull extends Migration
{
    public function up()
    {

        $this->alterColumn('{{%shop_delivery_methods}}', 'cost', $this->string(255)->null());

    }

}
