<?php

use yii\db\Migration;

/**
 * Class m201022_142819_change_narasi_analisis_isi_to_A
 */
class m201022_142819_change_narasi_analisis_isi_to_A extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameColumn('{{%k9_led_prodi_narasi_kondisi_eksternal}}','isi','_A');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%k9_led_prodi_narasi_kondisi_eksternal}}','_A','isi');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201022_142819_change_narasi_analisis_isi_to_A cannot be reverted.\n";

        return false;
    }
    */
}
