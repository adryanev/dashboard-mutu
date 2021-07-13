<?php

use yii\db\Migration;

/**
 * Class m210713_071139_add_komentar_to_dokumentasi_prodi
 */
class m210713_071139_add_komentar_to_dokumentasi_prodi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dokumentasi_prodi}}','komentar',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%dokumentasi_prodi}}','komentar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210713_071139_add_komentar_to_dokumentasi_prodi cannot be reverted.\n";

        return false;
    }
    */
}
