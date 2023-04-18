<?php

use yii\db\Migration;

class m230418_065725_create_characteristic_category_table extends Migration
{

    public function up()
    {
        $this->createTable('{{%shop_characteristic_category}}', [
            'category_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull()
        ]);
        $this->addPrimaryKey('{{%pk-shop_characteristic_category}}', '{{%shop_characteristic_category}}', ['category_id', 'characteristic_id']);
        $this->createIndex('{{%idx-shop_characteristic_category-category_id}}', '{{%shop_characteristic_category}}', 'category_id');
        $this->createIndex('{{%idx-shop_characteristic_category-characteristic_id}}', '{{%shop_characteristic_category}}', 'characteristic_id');
        $this->addForeignKey('{{%fk-shop_characteristic_category-category_id}}', '{{%shop_characteristic_category}}', 'category_id', '{{%shop_categories}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-shop_characteristic_category-characteristic_id}}', '{{%shop_characteristic_category}}', 'characteristic_id', '{{%shop_characteristics}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%characteristic_category}}');
    }
}
