<?php

use yii\db\Migration;

/**
 * Class m190914_082423_add_k9_kuantatif_table
 */
class m190914_082423_add_k9_kuantatif_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%k9_data_kuantitatif_prodi}}',[
            'id' => $this->primaryKey(),
            'id_akreditasi_prodi' => $this->integer(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-k9_data_kuantitatif_prodi-k9_akreditasi_prodi','{{%k9_data_kuantitatif_prodi}}','id_akreditasi_prodi','{{%k9_akreditasi_prodi}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk-k9_data_kuantitatif_prodi-usr_crt', '{{%k9_data_kuantitatif_prodi}}','created_by','{{%user}}', 'id','CASCADE','CASCADE');
        $this->addForeignKey('fk-k9_data_kuantitatif_prodi-usr_upd', '{{%k9_data_kuantitatif_prodi}}','updated_by','{{%user}}', 'id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk-k9_data_kuantitatif_prodi-usr_upd','{{%k9_data_kuantitatif_prodi}}');
        $this->dropForeignKey('fk-k9_data_kuantitatif_prodi-usr_crt','{{%k9_data_kuantitatif_prodi}}');
        $this->dropForeignKey('fk-k9_data_kuantitatif_prodi-k9_akreditasi_prodi','{{%k9_data_kuantitatif_prodi}}');
        $this->dropTable('{{%k9_data_kuantitatif_prodi}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190914_082423_add_k9_kuantatif_table cannot be reverted.\n";

        return false;
    }
    */
}
