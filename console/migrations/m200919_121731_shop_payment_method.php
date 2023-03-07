<?php

use yii\db\Migration;

/**
 * Class m200919_121731_shop_payment_method
 */
class m200919_121731_shop_payment_method extends Migration
{


    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%shop_payment_method}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);
        $this->createIndex('{{%idx-shop_brands-name}}', '{{%shop_brands}}', 'name', true);
    }
    public function down()
    {
        $this->dropTable('{{%shop_payment_method}}');
    }

}
