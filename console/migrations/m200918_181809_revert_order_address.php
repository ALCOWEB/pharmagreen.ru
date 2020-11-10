<?php

use yii\db\Migration;

/**
 * Class m200918_181809_revert_order_address
 */
class m200918_181809_revert_order_address extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropColumn('{{%shop_orders}}', 'region');
        $this->dropColumn('{{%shop_orders}}', 'city');
        $this->dropColumn('{{%shop_orders}}', 'street');
        $this->dropColumn('{{%shop_orders}}', 'home');
        $this->dropColumn('{{%shop_orders}}', 'office');
        $this->addColumn('{{%shop_orders}}', 'delivery_address', $this->text()->after('delivery_index'));

    }

    public function down()
    {
        $this->dropColumn('{{%shop_orders}}', 'delivery_address');
        $this->addColumn('{{%shop_orders}}', 'region', $this->text()->after('delivery_index'));
        $this->addColumn('{{%shop_orders}}', 'city', $this->text()->after('region'));
        $this->addColumn('{{%shop_orders}}', 'street', $this->text()->after('city'));
        $this->addColumn('{{%shop_orders}}', 'home', $this->text()->after('street'));
        $this->addColumn('{{%shop_orders}}', 'office', $this->text()->after('home'));

    }

}
