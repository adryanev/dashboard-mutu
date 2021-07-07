<?php

use yii\db\Migration;

/**
 * Class m201208_081357_alter_lkprodi_narasi_table
 */
class m201208_081357_alter_lkprodi_narasi_table extends Migration
{
    use \common\helpers\TextTypesTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        //1.1 - 1.3
        $this->renameColumn('{{%k9_lk_prodi_kriteria1_narasi}}', '_1', '_1__1');
        $this->addColumn('{{%k9_lk_prodi_kriteria1_narasi}}', '_1__2', $this->longtext());
        $this->addColumn('{{%k9_lk_prodi_kriteria1_narasi}}', '_1__3', $this->longText());

        //3.b.7-1 -- 3.b.7-4
        $this->renameColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7', '_3_b_7__1');
        $this->addColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7__2', $this->longText());
        $this->addColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7__3', $this->longText());
        $this->addColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7__4', $this->longText());

        //8.e.2-ref
        $this->addColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_e_2__ref', $this->longText());


        //8.f.4-1 - 8.f.4-4
        $this->renameColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4', '_8_f_4__1');
        $this->addColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4__2', $this->longText());
        $this->addColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4__3', $this->longText());
        $this->addColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4__4', $this->longText());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //1.1 - 1.3
        $this->renameColumn('{{%k9_lk_prodi_kriteria1_narasi}}', '_1__1', '_1_1');
        $this->dropColumn('{{%k9_lk_prodi_kriteria1_narasi}}', '_1__2');
        $this->dropColumn('{{%k9_lk_prodi_kriteria1_narasi}}', '_1__2');

        //3.b.7-1 -- 3.b.7-4
        $this->renameColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7__1', '_3_b_7');
        $this->dropColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7__2');
        $this->dropColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7__3');
        $this->dropColumn('{{%k9_lk_prodi_kriteria3_narasi}}', '_3_b_7__4');

        //8.e.2-ref
        $this->dropColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_e_2__ref');


        //8.f.4-1 - 8.f.4-4
        $this->renameColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4__1', '_8_f_4');
        $this->dropColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4__2');
        $this->dropColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4__3');
        $this->dropColumn('{{%k9_lk_prodi_kriteria8_narasi}}', '_8_f_4__4');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201208_081357_alter_lkprodi_narasi_table cannot be reverted.\n";

        return false;
    }
    */
}
