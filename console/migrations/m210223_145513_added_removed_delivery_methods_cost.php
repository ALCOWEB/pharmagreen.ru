<?php

use yii\db\Migration;

/**
 * Class m210223_145513_added_removed_delivery_methods_cost
 */
class m210223_145513_added_removed_delivery_methods_cost extends Migration
{

    public function up()
    {   $this->dropColumn('{{%shop_delivery_methods}}', 'cost');
        $this->addColumn('{{%shop_delivery_methods}}', 'cost', $this->integer()->after('name'));

    }

}
