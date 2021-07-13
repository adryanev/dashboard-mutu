<?php

use yii\db\Migration;

/**
 * Class m210713_141013_add_verified_and_komentar_to_led_details
 */
class m210713_141013_add_verified_and_komentar_to_led_details extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%k9_led_prodi_kriteria1_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria1_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria2_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria2_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria3_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria3_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria4_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria4_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria5_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria5_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria6_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria6_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria7_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria7_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria8_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria8_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_kriteria9_detail}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_kriteria9_detail}}','komentar',$this->string());

        $this->addColumn('{{%k9_led_prodi_non_kriteria_dokumen}}','is_verified',$this->boolean()->defaultValue(false));
        $this->addColumn('{{%k9_led_prodi_non_kriteria_dokumen}}','komentar',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%k9_led_prodi_kriteria1_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria1_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria2_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria2_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria3_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria3_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria4_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria4_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria5_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria5_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria6_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria6_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria7_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria7_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria8_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria8_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_kriteria9_detail}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_kriteria9_detail}}','komentar');

        $this->dropColumn('{{%k9_led_prodi_non_kriteria_dokumen}}','is_verified');
        $this->dropColumn('{{%k9_led_prodi_non_kriteria_dokumen}}','komentar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210713_141013_add_verified_and_komentar_to_led_details cannot be reverted.\n";

        return false;
    }
    */
}
