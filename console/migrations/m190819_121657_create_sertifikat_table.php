<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sertifikat_prodi}}`.
 */
class m190819_121657_create_sertifikat_table extends Migration
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

        $this->createTable('{{%sertifikat_prodi}}',[
            'id'=>$this->primaryKey(),
            'id_prodi'=>$this->integer(),
            'nama_lembaga'=>$this->string(),
            'tgl_akreditasi'=>$this->integer(),
            'tgl_kadaluarsa'=>$this->integer(),
            'nomor_sk'=>$this->string(),
            'nomor_sertifikat'=>$this->string(),
            'nilai_angka'=>$this->integer(),
            'nilai_huruf'=>$this->string(),
            'tahun_sk'=>$this->string(),
            'tanggal_pengajuan'=>$this->integer(),
            'tanggal_diterima'=>$this->integer(),
            'is_publik'=>$this->integer(),
            'dokumen_sk'=>$this->string(),
            'sertifikat'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'created_by'=>$this->integer(),
            'updated_by'=>$this->integer()
        ],$tableOptions);


        $this->addForeignKey('fk-sertifikat_prodi-prodi','{{%sertifikat_prodi}}','id_prodi','{{%program_studi}}','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-sertifikat_prodi-prodi','{{%sertifikat_prodi}}');
        $this->dropTable('{{%sertifikat_prodi}}');
    }
}
