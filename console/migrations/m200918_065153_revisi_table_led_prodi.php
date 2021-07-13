<?php

use yii\db\Migration;

/**
 * Class m200918_065153_revisi_table_led_prodi
 */
class m200918_065153_revisi_table_led_prodi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //drop current poin 4 kriteria
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria8}}', '_8_4');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria9}}', '_9_4');

        //create column kriteria
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_b', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_c', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_d', $this->text());

        $this->addColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4_b', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4_c', $this->text());

        $this->addColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_b', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_c', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_d', $this->text());

        $this->addColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4_b', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4_c', $this->text());

        $this->addColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4_b', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4_c', $this->text());

        $this->addColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4_b', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4_c', $this->text());

        $this->addColumn('{{%k9_led_prodi_narasi_kriteria8}}', '_8_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria8}}', '_8_4_b', $this->text());

        $this->addColumn('{{%k9_led_prodi_narasi_kriteria9}}', '_9_4_a', $this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria9}}', '_9_4_b', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //drop current poin 4 kriteria
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4',$this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4',$this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4',$this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4',$this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4',$this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4',$this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria8}}', '_8_4',$this->text());
        $this->addColumn('{{%k9_led_prodi_narasi_kriteria9}}', '_9_4',$this->text());

        //create column kriteria
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_b');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_c');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria2}}', '_2_4_d');

        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4_b');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria3}}', '_3_4_c');

        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_b');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_c');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria4}}', '_4_4_d');

        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4_b');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria5}}', '_5_4_c');

        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4_b');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria6}}', '_6_4_c');

        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4_b');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria7}}', '_7_4_c');

        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria8}}', '_8_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria8}}', '_8_4_b');

        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria9}}', '_9_4_a');
        $this->dropColumn('{{%k9_led_prodi_narasi_kriteria9}}', '_9_4_b');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200918_065153_revisi_table_led_prodi cannot be reverted.\n";

        return false;
    }
    */
}
