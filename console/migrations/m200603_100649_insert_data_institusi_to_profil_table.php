<?php

use common\models\Profil;
use yii\db\Migration;

/**
 * Class m200603_100649_insert_data_institusi_to_profil_table
 */
class m200603_100649_insert_data_institusi_to_profil_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%profil}}', ['type' => Profil::TIPE_INSTITUSI]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%profil}}', [
            'type' => Profil::TIPE_INSTITUSI,
            'visi' => null,
            'misi' => null,
            'tujuan' => null,
            'sasaran' => null,
            'motto' => null,
            'sambutan' => null,
            'struktur_organisasi' => 'placeholder.png',
            'created_at' => 0,
            'updated_at' => 0
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200603_100649_insert_data_institusi_to_profil_table cannot be reverted.\n";

        return false;
    }
    */
}
