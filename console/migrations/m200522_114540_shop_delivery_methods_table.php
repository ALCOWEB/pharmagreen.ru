<?php

use yii\db\Migration;

/**
 * Class m200522_114540_shop_delivery_methods_table
 */
class m200522_114540_shop_delivery_methods_table extends Migration
{  public function up()
{
    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    $this->createTable('{{%shop_delivery_methods}}', [
        'id' => $this->primaryKey(),
        'name' => $this->string()->notNull(),
        'cost' => $this->integer()->notNull(),
        'min_weight' => $this->integer(),
        'max_weight' => $this->integer(),
        'sort' => $this->integer()->notNull(),
    ], $tableOptions);
}

    public function down()
    {
        $this->dropTable('{{%shop_delivery_methods}}');
    }
}
