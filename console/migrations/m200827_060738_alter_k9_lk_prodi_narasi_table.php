<?php

use yii\db\Migration;

/**
 * Class m200827_060738_alter_k9_lk_prodi_narasi_table
 */
class m200827_060738_alter_k9_lk_prodi_narasi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-k9_lk_prodi_kt1-k9_lk_prodi','{{k9_lk_prodi_kriteria1_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt2-k9_lk_prodi','{{k9_lk_prodi_kriteria2_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt3-k9_lk_prodi','{{k9_lk_prodi_kriteria3_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt4-k9_lk_prodi','{{k9_lk_prodi_kriteria4_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt5-k9_lk_prodi','{{k9_lk_prodi_kriteria5_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt6-k9_lk_prodi','{{k9_lk_prodi_kriteria6_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt7-k9_lk_prodi','{{k9_lk_prodi_kriteria7_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt8-k9_lk_prodi','{{k9_lk_prodi_kriteria8_narasi}}');

        $this->renameColumn('{{k9_lk_prodi_kriteria1_narasi}}','id_lk_prodi','id_lk_prodi_kriteria1');
        $this->renameColumn('{{k9_lk_prodi_kriteria2_narasi}}','id_lk_prodi','id_lk_prodi_kriteria2');
        $this->renameColumn('{{k9_lk_prodi_kriteria3_narasi}}','id_lk_prodi','id_lk_prodi_kriteria3');
        $this->renameColumn('{{k9_lk_prodi_kriteria4_narasi}}','id_lk_prodi','id_lk_prodi_kriteria4');
        $this->renameColumn('{{k9_lk_prodi_kriteria5_narasi}}','id_lk_prodi','id_lk_prodi_kriteria5');
        $this->renameColumn('{{k9_lk_prodi_kriteria6_narasi}}','id_lk_prodi','id_lk_prodi_kriteria6');
        $this->renameColumn('{{k9_lk_prodi_kriteria7_narasi}}','id_lk_prodi','id_lk_prodi_kriteria7');
        $this->renameColumn('{{k9_lk_prodi_kriteria8_narasi}}','id_lk_prodi','id_lk_prodi_kriteria8');

        $this->addForeignKey('fk-k9_lk_prod_k1_n-k9_lk_prod_k1','{{%k9_lk_prodi_kriteria1_narasi}}','id_lk_prodi_kriteria1','{{%k9_lk_prodi_kriteria1}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k2_n-k9_lk_prod_k2','{{%k9_lk_prodi_kriteria2_narasi}}','id_lk_prodi_kriteria2','{{%k9_lk_prodi_kriteria2}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k3_n-k9_lk_prod_k3','{{%k9_lk_prodi_kriteria3_narasi}}','id_lk_prodi_kriteria3','{{%k9_lk_prodi_kriteria3}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k4_n-k9_lk_prod_k4','{{%k9_lk_prodi_kriteria4_narasi}}','id_lk_prodi_kriteria4','{{%k9_lk_prodi_kriteria4}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k5_n-k9_lk_prod_k5','{{%k9_lk_prodi_kriteria5_narasi}}','id_lk_prodi_kriteria5','{{%k9_lk_prodi_kriteria5}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k6_n-k9_lk_prod_k6','{{%k9_lk_prodi_kriteria6_narasi}}','id_lk_prodi_kriteria6','{{%k9_lk_prodi_kriteria6}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k7_n-k9_lk_prod_k7','{{%k9_lk_prodi_kriteria7_narasi}}','id_lk_prodi_kriteria7','{{%k9_lk_prodi_kriteria7}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k8_n-k9_lk_prod_k8','{{%k9_lk_prodi_kriteria8_narasi}}','id_lk_prodi_kriteria8','{{%k9_lk_prodi_kriteria8}}','id','cascade','cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-k9_lk_prod_k1_n-k9_lk_prod_k1','{{%k9_lk_prodi_kriteria1_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prod_k2_n-k9_lk_prod_k2','{{%k9_lk_prodi_kriteria2_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prod_k3_n-k9_lk_prod_k3','{{%k9_lk_prodi_kriteria3_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prod_k4_n-k9_lk_prod_k4','{{%k9_lk_prodi_kriteria4_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prod_k5_n-k9_lk_prod_k5','{{%k9_lk_prodi_kriteria5_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prod_k6_n-k9_lk_prod_k6','{{%k9_lk_prodi_kriteria6_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prod_k7_n-k9_lk_prod_k7','{{%k9_lk_prodi_kriteria7_narasi}}');
        $this->dropForeignKey('fk-k9_lk_prod_k8_n-k9_lk_prod_k8','{{%k9_lk_prodi_kriteria8_narasi}}');

        $this->renameColumn('{{k9_lk_prodi_kriteria1_narasi}}','id_lk_prodi_kriteria1','id_lk_prodi');
        $this->renameColumn('{{k9_lk_prodi_kriteria2_narasi}}','id_lk_prodi_kriteria2','id_lk_prodi');
        $this->renameColumn('{{k9_lk_prodi_kriteria3_narasi}}','id_lk_prodi_kriteria3','id_lk_prodi');
        $this->renameColumn('{{k9_lk_prodi_kriteria4_narasi}}','id_lk_prodi_kriteria4','id_lk_prodi');
        $this->renameColumn('{{k9_lk_prodi_kriteria5_narasi}}','id_lk_prodi_kriteria5','id_lk_prodi');
        $this->renameColumn('{{k9_lk_prodi_kriteria6_narasi}}','id_lk_prodi_kriteria6','id_lk_prodi');
        $this->renameColumn('{{k9_lk_prodi_kriteria7_narasi}}','id_lk_prodi_kriteria7','id_lk_prodi');
        $this->renameColumn('{{k9_lk_prodi_kriteria8_narasi}}','id_lk_prodi_kriteria8','id_lk_prodi');


        $this->addForeignKey('fk-k9_lk_prodi_kt1-k9_lk_prodi', '{{k9_lk_prodi_kriteria1_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt2-k9_lk_prodi', '{{k9_lk_prodi_kriteria2_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt3-k9_lk_prodi', '{{k9_lk_prodi_kriteria3_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt4-k9_lk_prodi', '{{k9_lk_prodi_kriteria4_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt5-k9_lk_prodi', '{{k9_lk_prodi_kriteria5_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt6-k9_lk_prodi', '{{k9_lk_prodi_kriteria6_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt7-k9_lk_prodi', '{{k9_lk_prodi_kriteria7_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt8-k9_lk_prodi', '{{k9_lk_prodi_kriteria8_narasi}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200827_060738_alter_k9_lk_prodi_narasi_table cannot be reverted.\n";

        return false;
    }
    */
}
