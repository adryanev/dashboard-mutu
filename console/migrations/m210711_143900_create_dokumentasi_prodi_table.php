<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dokumentasi_prodi}}`.
 */
class m210711_143900_create_dokumentasi_prodi_table extends Migration
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

        $this->createTable('{{%dokumentasi_prodi}}', [
            'id' => $this->primaryKey(),
            'id_prodi'=>$this->integer(),
            'nama_dokumen'=>$this->string(),
            'isi_dokumen'=>$this->string(),
            "bentuk_dokumen"=>$this->string(),
            'is_verified'=>$this->boolean(),
            "created_at"=>$this->integer(),
            "updated_at"=>$this->integer()

        ],$tableOptions);

        $this->addForeignKey('fk-dokumentasi_prodi-prodi','{{%dokumentasi_prodi}}','id_prodi','{{%program_studi}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dokumentasi_prodi}}');
    }
}
