<?php

use yii\db\Migration;

/**
 * Class m201008_042948_change_k9_dokumen_led_prodi_to_k9_prodi_ekspor_dokumen
 */
class m201008_042948_change_k9_dokumen_led_prodi_to_k9_prodi_ekspor_dokumen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameTable('{{%k9_dokumen_led_prodi}}','{{%k9_prodi_ekspor_dokumen}}');
        $this->addColumn('{{%k9_prodi_ekspor_dokumen}}','kode_dokumen',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%k9_prodi_ekspor_dokumen}}','kode_dokumen');

        $this->renameTable('{{%k9_prodi_ekspor_dokumen}}','{{%k9_dokumen_led_prodi}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201008_042948_change_k9_dokumen_led_prodi_to_k9_prodi_ekspor_dokumen cannot be reverted.\n";

        return false;
    }
    */
}
