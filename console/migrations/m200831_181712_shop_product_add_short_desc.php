<?php

use yii\db\Migration;

/**
 * Class m200831_181712_shop_product_add_short_desc
 */
class m200831_181712_shop_product_add_short_desc extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'short_desc', $this->text()->after('name'));
    }
    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'short_desc');
    }

}
