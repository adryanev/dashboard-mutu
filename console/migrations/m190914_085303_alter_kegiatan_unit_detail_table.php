<?php

use yii\db\Migration;

/**
 * Class m190914_085303_alter_kegiatan_unit_detail_table
 */
class m190914_085303_alter_kegiatan_unit_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%kegiatan_unit_detail}}','bentuk_file',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%kegiatan_unit_detail}}','bentuk_file');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190914_085303_alter_kegiatan_unit_detail_table cannot be reverted.\n";

        return false;
    }
    */
}
