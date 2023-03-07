<?php

use yii\db\Migration;

/**
 * Class m220703_181447_added_uom_to_characterisitcs_table
 */
class m220703_181447_added_uom_to_characterisitcs_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_characteristics}}', 'uom', $this->string()->after('type'));

    }

    public function down()
    {
        $this->dropColumn('{{%shop_characteristics}}', 'uom');
    }
}
