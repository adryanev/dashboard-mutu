<?php

use yii\db\Migration;

/**
 * Class m200827_071030_alter_table_lk_detail
 */
class m200827_071030_alter_table_lk_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-k9_lk_prodi_kt1_detail-k9_lk_prodi_kt1','{{k9_lk_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt2_detail-k9_lk_prodi_kt2','{{k9_lk_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt3_detail-k9_lk_prodi_kt3','{{k9_lk_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt4_detail-k9_lk_prodi_kt4','{{k9_lk_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt5_detail-k9_lk_prodi_kt5','{{k9_lk_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt6_detail-k9_lk_prodi_kt6','{{k9_lk_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt7_detail-k9_lk_prodi_kt7','{{k9_lk_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt8_detail-k9_lk_prodi_kt8','{{k9_lk_prodi_kriteria8_detail}}');

        $this->addForeignKey('fk-k9_lk_prodi_kt1_detail-k9_lk_prodi_kt1', '{{%k9_lk_prodi_kriteria1_detail}}', 'id_lk_prodi_kriteria1', '{{%k9_lk_prodi_kriteria1}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt2_detail-k9_lk_prodi_kt2', '{{%k9_lk_prodi_kriteria2_detail}}', 'id_lk_prodi_kriteria2', '{{%k9_lk_prodi_kriteria2}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt3_detail-k9_lk_prodi_kt3', '{{%k9_lk_prodi_kriteria3_detail}}', 'id_lk_prodi_kriteria3', '{{%k9_lk_prodi_kriteria3}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt4_detail-k9_lk_prodi_kt4', '{{%k9_lk_prodi_kriteria4_detail}}', 'id_lk_prodi_kriteria4', '{{%k9_lk_prodi_kriteria4}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt5_detail-k9_lk_prodi_kt5', '{{%k9_lk_prodi_kriteria5_detail}}', 'id_lk_prodi_kriteria5', '{{%k9_lk_prodi_kriteria5}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt6_detail-k9_lk_prodi_kt6', '{{%k9_lk_prodi_kriteria6_detail}}', 'id_lk_prodi_kriteria6', '{{%k9_lk_prodi_kriteria6}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt7_detail-k9_lk_prodi_kt7', '{{%k9_lk_prodi_kriteria7_detail}}', 'id_lk_prodi_kriteria7', '{{%k9_lk_prodi_kriteria7}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt8_detail-k9_lk_prodi_kt8', '{{%k9_lk_prodi_kriteria8_detail}}', 'id_lk_prodi_kriteria8', '{{%k9_lk_prodi_kriteria8}}', 'id', 'cascade', 'cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-k9_lk_prodi_kt1_detail-k9_lk_prodi_kt1','{{k9_lk_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt2_detail-k9_lk_prodi_kt2','{{k9_lk_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt3_detail-k9_lk_prodi_kt3','{{k9_lk_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt4_detail-k9_lk_prodi_kt4','{{k9_lk_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt5_detail-k9_lk_prodi_kt5','{{k9_lk_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt6_detail-k9_lk_prodi_kt6','{{k9_lk_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt7_detail-k9_lk_prodi_kt7','{{k9_lk_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt8_detail-k9_lk_prodi_kt8','{{k9_lk_prodi_kriteria8_detail}}');

        $this->addForeignKey('fk-k9_lk_prodi_kt1_detail-k9_lk_prodi_kt1', '{{%k9_lk_prodi_kriteria1_detail}}', 'id_lk_prodi_kriteria1', '{{%k9_lk_prodi_kriteria1}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt2_detail-k9_lk_prodi_kt2', '{{%k9_lk_prodi_kriteria2_detail}}', 'id_lk_prodi_kriteria2', '{{%k9_lk_prodi_kriteria2}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt3_detail-k9_lk_prodi_kt3', '{{%k9_lk_prodi_kriteria3_detail}}', 'id_lk_prodi_kriteria3', '{{%k9_lk_prodi_kriteria3}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt4_detail-k9_lk_prodi_kt4', '{{%k9_lk_prodi_kriteria4_detail}}', 'id_lk_prodi_kriteria4', '{{%k9_lk_prodi_kriteria4}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt5_detail-k9_lk_prodi_kt5', '{{%k9_lk_prodi_kriteria5_detail}}', 'id_lk_prodi_kriteria5', '{{%k9_lk_prodi_kriteria5}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt6_detail-k9_lk_prodi_kt6', '{{%k9_lk_prodi_kriteria6_detail}}', 'id_lk_prodi_kriteria6', '{{%k9_lk_prodi_kriteria6}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt7_detail-k9_lk_prodi_kt7', '{{%k9_lk_prodi_kriteria7_detail}}', 'id_lk_prodi_kriteria7', '{{%k9_lk_prodi_kriteria7}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt8_detail-k9_lk_prodi_kt8', '{{%k9_lk_prodi_kriteria8_detail}}', 'id_lk_prodi_kriteria8', '{{%k9_lk_prodi_kriteria8}}', 'id', 'cascade', 'cascade');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200827_071030_alter_table_lk_detail cannot be reverted.\n";

        return false;
    }
    */
}
