<?php

use yii\db\Migration;

/**
 * Class m220802_075029_add_characterisitc_slug
 */
class m220802_075029_add_characterisitc_slug extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_characteristics}}', 'slug', $this->string()->after('id'));
        $this->createIndex('{{%idx-shop_modifications-slug}}', '{{%shop_characteristics}}', 'slug');
    

    }

    public function down()
    {
        $this->dropColumn('{{%shop_characteristics}}', 'uom');
    }
}
