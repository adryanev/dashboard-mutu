<?php

use yii\db\Migration;

/**
 * Class m210123_050500_add_9b44_to_penilaian_prodi_table
 */
class m210123_050500_add_9b44_to_penilaian_prodi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%k9_penilaian_prodi_kriteria}}', '_9_4_b_4');
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%k9_penilaian_prodi_kriteria}}', '_9_4_b_4', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210123_050500_add_9b44_to_penilaian_prodi_table cannot be reverted.\n";

        return false;
    }
    */
}
