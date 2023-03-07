<?php

use yii\db\Migration;

/**
 * Class m200907_184407_changed_customer_data_orers_table
 */
class m200907_184407_changed_customer_data_orers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%shop_orders}}', 'customer_phone');
        $this->dropColumn('{{%shop_orders}}', 'customer_name');

        $this->addColumn('{{%shop_orders}}', 'first_name', $this->text()->after('statuses_json'));
        $this->addColumn('{{%shop_orders}}', 'last_name', $this->text()->after('first_name'));
        $this->addColumn('{{%shop_orders}}', 'phone', $this->text()->after('last_name'));
        $this->addColumn('{{%shop_orders}}', 'email', $this->text()->after('phone'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_orders}}', 'region');
        $this->dropColumn('{{%shop_orders}}', 'city');
        $this->dropColumn('{{%shop_orders}}', 'street');
        $this->dropColumn('{{%shop_orders}}', 'home');
        $this->dropColumn('{{%shop_orders}}', 'office');
        $this->addColumn('{{%shop_orders}}', 'customer_phone', $this->text()->after('statuses_json'));
        $this->addColumn('{{%shop_orders}}', 'customer_name', $this->text()->after('customer_phone'));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200907_184407_changed_customer_data_orers_table cannot be reverted.\n";

        return false;
    }
    */
}
