<?php

use yii\db\Migration;

/**
 * Class m210713_141019_add_verified_and_komentar_to_lk_details
 */
class m210713_141019_add_verified_and_komentar_to_lk_details extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%k9_lk_prodi_kriteria1_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria1_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_lk_prodi_kriteria2_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria2_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_lk_prodi_kriteria3_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria3_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_lk_prodi_kriteria4_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria4_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_lk_prodi_kriteria5_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria5_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_lk_prodi_kriteria6_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria6_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_lk_prodi_kriteria7_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria7_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_lk_prodi_kriteria8_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_lk_prodi_kriteria8_detail}}','komentar',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%k9_lk_prodi_kriteria1_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria1_detail}}','komentar');

        $this->dropColumn('{{%k9_lk_prodi_kriteria2_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria2_detail}}','komentar');

        $this->dropColumn('{{%k9_lk_prodi_kriteria3_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria3_detail}}','komentar');

        $this->dropColumn('{{%k9_lk_prodi_kriteria4_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria4_detail}}','komentar');

        $this->dropColumn('{{%k9_lk_prodi_kriteria5_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria5_detail}}','komentar');

        $this->dropColumn('{{%k9_lk_prodi_kriteria6_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria6_detail}}','komentar');

        $this->dropColumn('{{%k9_lk_prodi_kriteria7_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria7_detail}}','komentar');

        $this->dropColumn('{{%k9_lk_prodi_kriteria8_detail}}','is_verified');
        $this->dropColumn('{{%k9_lk_prodi_kriteria8_detail}}','komentar');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210713_141019_add_verified_and_komentar_to_lk_details cannot be reverted.\n";

        return false;
    }
    */
}
