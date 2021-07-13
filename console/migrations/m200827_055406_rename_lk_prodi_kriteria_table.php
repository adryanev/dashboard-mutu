<?php

use yii\db\Migration;

/**
 * Class m200827_055406_rename_lk_prodi_kriteria_table
 */
class m200827_055406_rename_lk_prodi_kriteria_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameTable('k9_lk_prodi_kriteria1','k9_lk_prodi_kriteria1_narasi');
        $this->renameTable('k9_lk_prodi_kriteria2','k9_lk_prodi_kriteria2_narasi');
        $this->renameTable('k9_lk_prodi_kriteria3','k9_lk_prodi_kriteria3_narasi');
        $this->renameTable('k9_lk_prodi_kriteria4','k9_lk_prodi_kriteria4_narasi');
        $this->renameTable('k9_lk_prodi_kriteria5','k9_lk_prodi_kriteria5_narasi');
        $this->renameTable('k9_lk_prodi_kriteria6','k9_lk_prodi_kriteria6_narasi');
        $this->renameTable('k9_lk_prodi_kriteria7','k9_lk_prodi_kriteria7_narasi');
        $this->renameTable('k9_lk_prodi_kriteria8','k9_lk_prodi_kriteria8_narasi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->renameTable('k9_lk_prodi_kriteria1_narasi','k9_lk_prodi_kriteria1');
        $this->renameTable('k9_lk_prodi_kriteria2_narasi','k9_lk_prodi_kriteria2');
        $this->renameTable('k9_lk_prodi_kriteria3_narasi','k9_lk_prodi_kriteria3');
        $this->renameTable('k9_lk_prodi_kriteria4_narasi','k9_lk_prodi_kriteria4');
        $this->renameTable('k9_lk_prodi_kriteria5_narasi','k9_lk_prodi_kriteria5');
        $this->renameTable('k9_lk_prodi_kriteria6_narasi','k9_lk_prodi_kriteria6');
        $this->renameTable('k9_lk_prodi_kriteria7_narasi','k9_lk_prodi_kriteria7');
        $this->renameTable('k9_lk_prodi_kriteria8_narasi','k9_lk_prodi_kriteria8');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200827_055406_rename_lk_prodi_kriteria_table cannot be reverted.\n";

        return false;
    }
    */
}
