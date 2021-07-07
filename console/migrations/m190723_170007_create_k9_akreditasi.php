<?php

use yii\db\Migration;

/**
 * Class m190723_170007_create_k9_akreditasi
 */
class m190723_170007_create_k9_akreditasi extends Migration
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

        $this->createTable('{{%k9_akreditasi}}',[
            'id'=>$this->primaryKey(),
            'nama'=>$this->string(),
            'tahun'=>$this->string(4),
            'jenis_akreditasi'=>$this->string(10),
            'lembaga'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->createTable('{{%k9_akreditasi_prodi}}',[
            'id'=>$this->primaryKey(),
            'id_akreditasi'=>$this->integer(),
            'id_prodi'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);


        $this->addForeignKey('fk-k9_akreditasi_prodi-k9_akreditasi','{{%k9_akreditasi_prodi}}','id_akreditasi','{{%k9_akreditasi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_akreditasi_prodi-program_studi','{{%k9_akreditasi_prodi}}','id_prodi','{{%program_studi}}','id','cascade','cascade');



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-k9_akreditasi_prodi-k9_akreditasi','{{%k9_akreditasi_prodi}}');
        $this->dropForeignKey('fk-k9_akreditasi_prodi-program_studi','{{%k9_akreditasi_prodi}}');

        $this->dropTable('{{%k9_akreditasi_prodi}}');
        $this->dropTable('{{%k9_akreditasi_akreditasi}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190723_170007_create_k9_akreditasi cannot be reverted.\n";

        return false;
    }
    */
}
