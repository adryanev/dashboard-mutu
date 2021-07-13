<?php

use yii\db\Migration;

/**
 * Class m210119_061759_insert_another_profil_institusi_table
 */
class m210119_061759_insert_another_profil_institusi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%profil_institusi}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            ['jenis', 'akademik', 0, 0],
            ['bentuk', 'blu', 0, 0],
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
        echo "m210119_061759_insert_another_profil_institusi_table cannot be reverted.\n";

        return false;
    }
    */
}
