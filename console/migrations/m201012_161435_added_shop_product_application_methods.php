<?php

use yii\db\Migration;

/**
 * Class m201012_161435_added_shop_product_application_methods
 */
class m201012_161435_added_shop_product_application_methods extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'application_methods', $this->text()->after('short_desc'));
    }
    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'application_methods');
    }
}
