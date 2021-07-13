<?php

use yii\db\Migration;

/**
 * Class m200928_091526_add_progress_to_eksternal_profil_analisis
 */
class m200928_091526_add_progress_to_eksternal_profil_analisis extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%k9_led_prodi_narasi_kondisi_eksternal}}','progress',$this->float());
        $this->addColumn('{{%k9_led_prodi_narasi_profil_upps}}','progress',$this->float());
        $this->addColumn('{{%k9_led_prodi_narasi_analisis}}','progress',$this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%k9_led_prodi_narasi_kondisi_eksternal}}','progress');
        $this->dropColumn('{{%k9_led_prodi_narasi_profil_upps}}','progress');
        $this->dropColumn('{{%k9_led_prodi_narasi_analisis}}','progress');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200928_091526_add_progress_to_eksternal_profil_analisis cannot be reverted.\n";

        return false;
    }
    */
}
