<?php

use yii\db\Migration;

/**
 * Class m201204_042329_alter_penilaiaian_prodi_analisis_table
 */
class m201204_042329_alter_penilaiaian_prodi_analisis_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_1', '_1_1');
        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_2', '_2_1');
        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_3', '_3_1');
        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_4', '_4_1');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_1_1', '_1');
        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_2_1', '_2');
        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_3_1', '_3');
        $this->renameColumn('{{%k9_penilaian_prodi_analisis}}', '_4_1', '_4');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201204_042329_alter_penilaiaian_prodi_analisis_table cannot be reverted.\n";

        return false;
    }
    */
}
