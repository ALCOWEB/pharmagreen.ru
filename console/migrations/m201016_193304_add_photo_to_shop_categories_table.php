<?php

use yii\db\Migration;

/**
 * Class m201016_193304_add_photo_to_shop_categories_table
 */
class m201016_193304_add_photo_to_shop_categories_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_categories}}', 'photo', $this->string()->after('description'));
    }

    public function down()
    {

        $this->dropColumn('{{%shop_categories}}', 'id_hash');
        return false;
    }
}
