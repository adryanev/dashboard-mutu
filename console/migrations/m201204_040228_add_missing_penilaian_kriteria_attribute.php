<?php

use yii\db\Migration;

/**
 * Class m201204_040228_add_missing_penilaian_kriteria_attribute
 */
class m201204_040228_add_missing_penilaian_kriteria_attribute extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_a', '_2_4_a_A');
        $this->addColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_a_B', $this->integer());
        $this->renameColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_b', '_2_4_b_A');
        $this->addColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_b_B', $this->integer());
        $this->renameColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_c', '_2_4_c_1');
        $this->addColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_c_A', $this->integer());
        $this->addColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_c_B', $this->integer());
        $this->addColumn('{{%k9_penilaian_prodi_kriteria}}', '_6_4_d_1', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_a_A', '_2_4_a');
        $this->dropColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_a_B');
        $this->renameColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_b_A', '_2_4_b');
        $this->dropColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_b_B');
        $this->renameColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_c_1', '_2_4_c');
        $this->dropColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_c_A');
        $this->dropColumn('{{%k9_penilaian_prodi_kriteria}}', '_2_4_c_B');
        $this->dropColumn('{{%k9_penilaian_prodi_kriteria}}', '_6_4_d_1');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201204_040228_add_missing_penilaian_kriteria_attribute cannot be reverted.\n";

        return false;
    }
    */
}
