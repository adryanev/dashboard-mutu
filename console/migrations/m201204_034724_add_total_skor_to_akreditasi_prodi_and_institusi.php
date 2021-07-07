<?php

use yii\db\Migration;

/**
 * Class m201204_034724_add_total_skor_to_akreditasi_prodi_and_institusi
 */
class m201204_034724_add_total_skor_to_akreditasi_prodi_and_institusi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%k9_akreditasi_prodi}}', 'skor', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropColumn('{{%k9_akreditasi_prodi}}', 'skor');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201204_034724_add_total_skor_to_akreditasi_prodi_and_institusi cannot be reverted.\n";

        return false;
    }
    */
}
