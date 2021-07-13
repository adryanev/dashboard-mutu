<?php

use yii\db\Migration;

/**
 * Class m190723_165629_init_kriteria_database
 */
class m190723_165629_init_kriteria_database extends Migration
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

        $this->createTable('{{%profil_user}}',[
            'id'=>$this->primaryKey(),
            'id_user'=>$this->integer(),
            'nama_lengkap'=>$this->string(),
            'id_prodi'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->createTable('{{%program_studi}}',[
            'id'=>$this->primaryKey(),
            'kode'=>$this->string(),
            'nama'=>$this->string(),
            'jurusan_departemen'=>$this->string(),
            'nomor_sk_pendirian'=>$this->string(),
            'tanggal_sk_pendirian'=>$this->integer(),
            'pejabat_ttd_sk_pendirian'=>$this->string(),
            'bulan_berdiri'=>$this->integer(),
            'tahun_berdiri'=>$this->string(4),
            'nomor_sk_operasional'=>$this->string(),
            'tanggal_sk_operasional'=>$this->integer(),
            'peringkat_banpt_terakhir'=>$this->string(),
            'nilai_banpt_terakhir'=>$this->integer(),
            'nomor_sk_banpt'=>$this->string(),
            'alamat'=>$this->string(),
            'kodepos'=>$this->string(),
            'nomor_telp'=>$this->string(),
            'homepage'=>$this->string(),
            'email'=>$this->string(),
            'kaprodi'=>$this->string(),
            'jenjang'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->createTable('{{%unit}}',[
            'id'=>$this->primaryKey(),
            'nama'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%unit}}');
        $this->dropTable('{{%program_studi}}');
        $this->dropTable('{{%profil_user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190723_165629_init_kriteria_database cannot be reverted.\n";

        return false;
    }
    */
}
