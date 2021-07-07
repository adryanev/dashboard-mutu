<?php

use common\helpers\TextTypesTrait;
use yii\db\Migration;

/**
 * Class m190723_094307_add_tabel_led
 */
class m190723_170054_create_tabel_led extends Migration
{
    use TextTypesTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTabelProdi();


    }

    private function createTabelProdi()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        //LED PRODI
        $this->createTable('{{%k9_led_prodi}}', [
            'id' => $this->primaryKey(),
            'id_akreditasi_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        // LED PRODI KRITERIA 1-9
        $this->createTable('k9_led_prodi_kriteria1', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria2', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria3', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria4', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria5', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria6', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria7', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria8', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria9', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        // Narasi LED PRODI KRITERIA 1-9
        $this->createTable('k9_led_prodi_narasi_kriteria1', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria1' => $this->integer(),
            '_1_1' => $this->longText(),
            '_1_2' => $this->longText(),
            '_1_3' => $this->longText(),
            '_1_4' => $this->longText(),
            '_1_5' => $this->longText(),
            '_1_6' => $this->longText(),
            '_1_7' => $this->longText(),
            '_1_8' => $this->longText(),
            '_1_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria2', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria2' => $this->integer(),
            '_2_1' => $this->longText(),
            '_2_2' => $this->longText(),
            '_2_3' => $this->longText(),
            '_2_4' => $this->longText(),
            '_2_5' => $this->longText(),
            '_2_6' => $this->longText(),
            '_2_7' => $this->longText(),
            '_2_8' => $this->longText(),
            '_2_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria3', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria3' => $this->integer(),
            '_3_1' => $this->longText(),
            '_3_2' => $this->longText(),
            '_3_3' => $this->longText(),
            '_3_4' => $this->longText(),
            '_3_5' => $this->longText(),
            '_3_6' => $this->longText(),
            '_3_7' => $this->longText(),
            '_3_8' => $this->longText(),
            '_3_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria4', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria4' => $this->integer(),
            '_4_1' => $this->longText(),
            '_4_2' => $this->longText(),
            '_4_3' => $this->longText(),
            '_4_4' => $this->longText(),
            '_4_5' => $this->longText(),
            '_4_6' => $this->longText(),
            '_4_7' => $this->longText(),
            '_4_8' => $this->longText(),
            '_4_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria5', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria5' => $this->integer(),
            '_5_1' => $this->longText(),
            '_5_2' => $this->longText(),
            '_5_3' => $this->longText(),
            '_5_4' => $this->longText(),
            '_5_5' => $this->longText(),
            '_5_6' => $this->longText(),
            '_5_7' => $this->longText(),
            '_5_8' => $this->longText(),
            '_5_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria6', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria6' => $this->integer(),
            '_6_1' => $this->longText(),
            '_6_2' => $this->longText(),
            '_6_3' => $this->longText(),
            '_6_4' => $this->longText(),
            '_6_5' => $this->longText(),
            '_6_6' => $this->longText(),
            '_6_7' => $this->longText(),
            '_6_8' => $this->longText(),
            '_6_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria7', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria7' => $this->integer(),
            '_7_1' => $this->longText(),
            '_7_2' => $this->longText(),
            '_7_3' => $this->longText(),
            '_7_4' => $this->longText(),
            '_7_5' => $this->longText(),
            '_7_6' => $this->longText(),
            '_7_7' => $this->longText(),
            '_7_8' => $this->longText(),
            '_7_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria8', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria8' => $this->integer(),
            '_8_1' => $this->longText(),
            '_8_2' => $this->longText(),
            '_8_3' => $this->longText(),
            '_8_4' => $this->longText(),
            '_8_5' => $this->longText(),
            '_8_6' => $this->longText(),
            '_8_7' => $this->longText(),
            '_8_8' => $this->longText(),
            '_8_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_narasi_kriteria9', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria9' => $this->integer(),
            '_9_1' => $this->longText(),
            '_9_2' => $this->longText(),
            '_9_3' => $this->longText(),
            '_9_4' => $this->longText(),
            '_9_5' => $this->longText(),
            '_9_6' => $this->longText(),
            '_9_7' => $this->longText(),
            '_9_8' => $this->longText(),
            '_9_9' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);


        // LED PRODI KRITERIA 1-9 DETAIL
        $this->createTable('k9_led_prodi_kriteria1_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria1' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria2_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria2' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria3_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria3' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria4_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria4' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria5_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria5' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria6_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria6' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria7_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria7' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria8_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria8' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_led_prodi_kriteria9_detail', [
            'id' => $this->primaryKey(),
            'id_led_prodi_kriteria9' => $this->integer(),
            'kode_dokumen' => $this->string(),
            'nama_dokumen' => $this->string(),
            'isi_dokumen' => $this->string(),
            'jenis_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);
        $this->addForeignProdi();
    }

    private function addForeignProdi()
    {
        $this->addForeignKey('fk-k9_led_prodi-k9_akreditasi_prodi', '{{%k9_led_prodi}}', 'id_akreditasi_prodi', '{{%k9_akreditasi_prodi}}', 'id', 'cascade', 'cascade');


        $this->addForeignKey('fk-k9_led_prodi_kt1-k9_led_prodi', '{{k9_led_prodi_kriteria1}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt2-k9_led_prodi', '{{k9_led_prodi_kriteria2}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt3-k9_led_prodi', '{{k9_led_prodi_kriteria3}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt4-k9_led_prodi', '{{k9_led_prodi_kriteria4}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt5-k9_led_prodi', '{{k9_led_prodi_kriteria5}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt6-k9_led_prodi', '{{k9_led_prodi_kriteria6}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt7-k9_led_prodi', '{{k9_led_prodi_kriteria7}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt8-k9_led_prodi', '{{k9_led_prodi_kriteria8}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt9-k9_led_prodi', '{{k9_led_prodi_kriteria9}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');

        $this->addForeignKey('fk-k9_led_prodi_n_kt1-k9_led_prodi_kt1', '{{k9_led_prodi_narasi_kriteria1}}', 'id_led_prodi_kriteria1', '{{%k9_led_prodi_kriteria1}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt2-k9_led_prodi_kt2', '{{k9_led_prodi_narasi_kriteria2}}', 'id_led_prodi_kriteria2', '{{%k9_led_prodi_kriteria2}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt3-k9_led_prodi_kt3', '{{k9_led_prodi_narasi_kriteria3}}', 'id_led_prodi_kriteria3', '{{%k9_led_prodi_kriteria3}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt4-k9_led_prodi_kt4', '{{k9_led_prodi_narasi_kriteria4}}', 'id_led_prodi_kriteria4', '{{%k9_led_prodi_kriteria4}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt5-k9_led_prodi_kt5', '{{k9_led_prodi_narasi_kriteria5}}', 'id_led_prodi_kriteria5', '{{%k9_led_prodi_kriteria5}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt6-k9_led_prodi_kt6', '{{k9_led_prodi_narasi_kriteria6}}', 'id_led_prodi_kriteria6', '{{%k9_led_prodi_kriteria6}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt7-k9_led_prodi_kt7', '{{k9_led_prodi_narasi_kriteria7}}', 'id_led_prodi_kriteria7', '{{%k9_led_prodi_kriteria7}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt8-k9_led_prodi_kt8', '{{k9_led_prodi_narasi_kriteria8}}', 'id_led_prodi_kriteria8', '{{%k9_led_prodi_kriteria8}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_n_kt9-k9_led_prodi_kt9', '{{k9_led_prodi_narasi_kriteria9}}', 'id_led_prodi_kriteria9', '{{%k9_led_prodi_kriteria9}}', 'id', 'cascade', 'cascade');


        $this->addForeignKey('fk-k9_led_prodi_kt1_detail-k9_led_prodi_kt1', '{{k9_led_prodi_kriteria1_detail}}', 'id_led_prodi_kriteria1', '{{%k9_led_prodi_kriteria1}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt2_detail-k9_led_prodi_kt2', '{{k9_led_prodi_kriteria2_detail}}', 'id_led_prodi_kriteria2', '{{%k9_led_prodi_kriteria2}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt3_detail-k9_led_prodi_kt3', '{{k9_led_prodi_kriteria3_detail}}', 'id_led_prodi_kriteria3', '{{%k9_led_prodi_kriteria3}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt4_detail-k9_led_prodi_kt4', '{{k9_led_prodi_kriteria4_detail}}', 'id_led_prodi_kriteria4', '{{%k9_led_prodi_kriteria4}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt5_detail-k9_led_prodi_kt5', '{{k9_led_prodi_kriteria5_detail}}', 'id_led_prodi_kriteria5', '{{%k9_led_prodi_kriteria5}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt6_detail-k9_led_prodi_kt6', '{{k9_led_prodi_kriteria6_detail}}', 'id_led_prodi_kriteria6', '{{%k9_led_prodi_kriteria6}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt7_detail-k9_led_prodi_kt7', '{{k9_led_prodi_kriteria7_detail}}', 'id_led_prodi_kriteria7', '{{%k9_led_prodi_kriteria7}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt8_detail-k9_led_prodi_kt8', '{{k9_led_prodi_kriteria8_detail}}', 'id_led_prodi_kriteria8', '{{%k9_led_prodi_kriteria8}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt9_detail-k9_led_prodi_kt9', '{{k9_led_prodi_kriteria9_detail}}', 'id_led_prodi_kriteria9', '{{%k9_led_prodi_kriteria9}}', 'id', 'cascade', 'cascade');


        $this->addForeignKey('fk-k9_led_prodi_kt1_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria1}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt2_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria2}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt3_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria3}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt4_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria4}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt5_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria5}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt6_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria6}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt7_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria7}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt8_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria8}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt9_n_crd-usr_crd', '{{k9_led_prodi_narasi_kriteria9}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');

        $this->addForeignKey('fk-k9_led_prodi_kt1_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria1}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt2_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria2}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt3_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria3}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt4_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria4}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt5_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria5}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt6_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria6}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt7_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria7}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt8_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria8}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt9_n_upd-usr_upd', '{{k9_led_prodi_narasi_kriteria9}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');


        $this->addForeignKey('fk-k9_led_prodi_kt1_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria1_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt2_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria2_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt3_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria3_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt4_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria4_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt5_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria5_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt6_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria6_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt7_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria7_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt8_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria8_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt9_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria9_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');

        $this->addForeignKey('fk-k9_led_prodi_kt1_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria1_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt2_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria2_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt3_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria3_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt4_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria4_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt5_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria5_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt6_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria6_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt7_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria7_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt8_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria8_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_led_prodi_kt9_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria9_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');


    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTabelProdi();
    }

    private function dropTabelProdi()
    {
        $this->dropForeignProdi();


        $this->dropTable('k9_led_prodi_kriteria_9_detail');
        $this->dropTable('k9_led_prodi_kriteria_8_detail');
        $this->dropTable('k9_led_prodi_kriteria_7_detail');
        $this->dropTable('k9_led_prodi_kriteria_6_detail');
        $this->dropTable('k9_led_prodi_kriteria_5_detail');
        $this->dropTable('k9_led_prodi_kriteria_4_detail');
        $this->dropTable('k9_led_prodi_kriteria_3_detail');
        $this->dropTable('k9_led_prodi_kriteria_2_detail');
        $this->dropTable('k9_led_prodi_kriteria_1_detail');


        $this->dropTable('k9_led_prodi_kriteria_9');
        $this->dropTable('k9_led_prodi_kriteria_8');
        $this->dropTable('k9_led_prodi_kriteria_7');
        $this->dropTable('k9_led_prodi_kriteria_6');
        $this->dropTable('k9_led_prodi_kriteria_5');
        $this->dropTable('k9_led_prodi_kriteria_4');
        $this->dropTable('k9_led_prodi_kriteria_3');
        $this->dropTable('k9_led_prodi_kriteria_2');
        $this->dropTable('k9_led_prodi_kriteria_1');

        $this->dropTable('k9_led_prodi_narasi_kriteria_9');
        $this->dropTable('k9_led_prodi_narasi_kriteria_8');
        $this->dropTable('k9_led_prodi_narasi_kriteria_7');
        $this->dropTable('k9_led_prodi_narasi_kriteria_6');
        $this->dropTable('k9_led_prodi_narasi_kriteria_5');
        $this->dropTable('k9_led_prodi_narasi_kriteria_4');
        $this->dropTable('k9_led_prodi_narasi_kriteria_3');
        $this->dropTable('k9_led_prodi_narasi_kriteria_2');
        $this->dropTable('k9_led_prodi_narasi_kriteria_1');

        $this->dropTable('{{%k9_led_prodi}}');

    }

    private function dropForeignProdi()
    {
        $this->dropForeignKey('fk-k9_led_prodi-k9_akreditasi_prodi', '{{%k9_akreditasi_prodi}}');

        $this->dropForeignKey('fk-k9_led_prodi_n_kt1-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria1}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt2-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria2}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt3-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria3}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt4-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria4}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt5-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria5}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt6-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria6}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt7-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria7}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt8-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria8}}');
        $this->dropForeignKey('fk-k9_led_prodi_n_kt9-k9_led_prodi', '{{k9_led_prodi_narasi_kriteria9}}');

        $this->dropForeignKey('fk-k9_led_prodi_kt1-k9_led_prodi', '{{k9_led_prodi_kriteria1}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt2-k9_led_prodi', '{{k9_led_prodi_kriteria2}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt3-k9_led_prodi', '{{k9_led_prodi_kriteria3}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt4-k9_led_prodi', '{{k9_led_prodi_kriteria4}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt5-k9_led_prodi', '{{k9_led_prodi_kriteria5}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt6-k9_led_prodi', '{{k9_led_prodi_kriteria6}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt7-k9_led_prodi', '{{k9_led_prodi_kriteria7}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt8-k9_led_prodi', '{{k9_led_prodi_kriteria8}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt9-k9_led_prodi', '{{k9_led_prodi_kriteria9}}');

        $this->dropForeignKey('fk-k9_led_prodi_kt1_detail-k9_led_prodi_kt1', '{{k9_led_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt2_detail-k9_led_prodi_kt2', '{{k9_led_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt3_detail-k9_led_prodi_kt3', '{{k9_led_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt4_detail-k9_led_prodi_kt4', '{{k9_led_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt5_detail-k9_led_prodi_kt5', '{{k9_led_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt6_detail-k9_led_prodi_kt6', '{{k9_led_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt7_detail-k9_led_prodi_kt7', '{{k9_led_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt8_detail-k9_led_prodi_kt8', '{{k9_led_prodi_kriteria8_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt9_detail-k9_led_prodi_kt9', '{{k9_led_prodi_kriteria9_detail}}');


        $this->dropForeignKey('fk-k9_led_prodi_kt1_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt2_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt3_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt4_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt5_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt6_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt7_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt8_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria8_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt9_dtl_crd-usr_crd', '{{k9_led_prodi_kriteria9_detail}}');

        $this->dropForeignKey('fk-k9_led_prodi_kt1_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt2_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt3_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt4_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt5_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt6_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt7_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt8_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria8_detail}}');
        $this->dropForeignKey('fk-k9_led_prodi_kt9_dtl_upd-usr_upd', '{{k9_led_prodi_kriteria9_detail}}');

    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190723_094307_add_tabel_led cannot be reverted.\n";

        return false;
    }
    */
}
