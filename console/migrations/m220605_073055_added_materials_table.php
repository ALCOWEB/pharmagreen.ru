<?php

use yii\db\Migration;

/**
 * Class m220605_073055_added_materials_table
 */
class m220605_073055_added_materials_table extends Migration
{
   /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%materials}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'akril_5mm'=> $this->integer()->notNull(),
            'akril_3mm'=> $this->integer()->notNull(),
            'akril_4mm'=> $this->integer()->notNull(),
            'pvh_2mm'=> $this->integer()->notNull(),
            'policarb_2mm'=> $this->integer()->notNull(),
            'pet_1mm'=> $this->integer()->notNull(),
            'pet_05mm'=> $this->integer()->notNull(),
            'svetodiody'=> $this->integer()->notNull(),
            'blok24'=> $this->integer()->notNull(),
            'blok36'=> $this->integer()->notNull(),
            'blok48'=> $this->integer()->notNull(),
            'blok60'=> $this->integer()->notNull(),
            'derj_tabl_verh'=> $this->integer()->notNull(),
            'derj_dist'=> $this->integer()->notNull(),
            'kronsht_cang'=> $this->integer()->notNull(),
            'pechat'=> $this->integer()->notNull(),
            'scoch'=> $this->integer()->notNull(),
            'tross'=> $this->integer()->notNull(),
            'provod'=> $this->integer()->notNull(),
            'ugolok'=> $this->integer()->notNull(),
            'prujina'=> $this->integer()->notNull(),
            'podves_frame'=> $this->integer()->notNull(),
            'profil_frame'=> $this->integer()->notNull(),
            'profil_frame_2storon'=> $this->integer()->notNull(),
            'profil_magnet'=> $this->integer()->notNull(),
            'magnitiki'=> $this->integer()->notNull(),
            'golovki'=> $this->integer()->notNull(),
            'yashCost'=> $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(null)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%materials}}');
    }
}
