<?php

use yii\db\Migration;

/**
 * Class m210313_092801_add_more_profil_institusi
 */
class m210313_092801_add_more_profil_institusi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210313_092801_add_more_profil_institusi cannot be reverted.\n";

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->truncateTable('{{%profil_institusi}}');
        $data = [
            ['nama', 'UIN SUSKA RIAU', 0, 0],
            ['alamat', 'Jl. Hr Soebrantas', 0, 0],
            ['kota', 'Pekanbaru', 0, 0],
            ['kode_pos', '29543', 0, 0],
            ['nomor_telepon', '076120102', 0, 0],
            ['email', 'support@uin-suska.ac.id', 0, 0],
            ['website', 'https://uin-suska.ac.id', 0, 0],
            ['nomor_sk_pendirian', '', 0, 0],
            ['tanggal_sk_pendirian', '', 0, 0],
            ['peringkat_akreditasi_banpt', '', 0, 0],
            ['nomor_sk_banpt', '', 0, 0],
            ['jenis_pengelolaan', 'blu', 0, 0],
            ['bentuk', 'akademik', 0, 0]

        ];
        $this->batchInsert('{{%profil_institusi}}', ['nama', 'isi', 'created_at', 'updated_at'], $data);

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210313_092801_add_more_profil_institusi cannot be reverted.\n";

        return false;
    }
    */
}
