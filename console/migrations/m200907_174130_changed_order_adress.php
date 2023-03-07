<?php

use yii\db\Migration;

/**
 * Class m200907_174130_changed_order_adress
 */
class m200907_174130_changed_order_adress extends Migration
{
    public function up()
    {   $this->dropColumn('{{%shop_orders}}', 'delivery_address');
        $this->addColumn('{{%shop_orders}}', 'region', $this->text()->after('delivery_index'));
        $this->addColumn('{{%shop_orders}}', 'city', $this->text()->after('region'));
        $this->addColumn('{{%shop_orders}}', 'street', $this->text()->after('city'));
        $this->addColumn('{{%shop_orders}}', 'home', $this->text()->after('street'));
        $this->addColumn('{{%shop_orders}}', 'office', $this->text()->after('home'));

    }
    public function down()
    {
        $this->dropColumn('{{%shop_orders}}', 'region');
        $this->dropColumn('{{%shop_orders}}', 'city');
        $this->dropColumn('{{%shop_orders}}', 'street');
        $this->dropColumn('{{%shop_orders}}', 'home');
        $this->dropColumn('{{%shop_orders}}', 'office');
        $this->addColumn('{{%shop_orders}}', 'delivery_address', $this->text()->after('delivery_index'));
    }

}
