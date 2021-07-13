<?php

use common\helpers\TextTypesTrait;
use yii\db\Migration;

/**
 * Class m190723_094232_add_tabel_lk
 */
class m190724_052006_create_tabel_lk extends Migration
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
        $this->createTable('{{%k9_lk_prodi}}', [
            'id' => $this->primaryKey(),
            'id_akreditasi_prodi' => $this->integer(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);


        // LED PRODI KRITERIA 1-9
        $this->createTable('k9_lk_prodi_kriteria1', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_1' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_lk_prodi_kriteria2', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_2_a' => $this->longText(),
            '_2_b' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_lk_prodi_kriteria3', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_3_a_1' => $this->longText(),
            '_3_a_2' => $this->longText(),
            '_3_a_3' => $this->longText(),
            '_3_a_4' => $this->longText(),
            '_3_a_5' => $this->longText(),
            '_3_b_1' => $this->longText(),
            '_3_b_2' => $this->longText(),
            '_3_b_3' => $this->longText(),
            '_3_b_4' => $this->longText(),
            '_3_b_5' => $this->longText(),
            '_3_b_6' => $this->longText(),
            '_3_b_7' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_lk_prodi_kriteria4', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_4' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_lk_prodi_kriteria5', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_5_a' => $this->longText(),
            '_5_b' => $this->longText(),
            '_5_c' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_lk_prodi_kriteria6', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_6_a' => $this->longText(),
            '_6_b' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_lk_prodi_kriteria7', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_7' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('k9_lk_prodi_kriteria8', [
            'id' => $this->primaryKey(),
            'id_lk_prodi' => $this->integer(),
            '_8_a' => $this->longText(),
            '_8_b_1' => $this->longText(),
            '_8_b_2' => $this->longText(),
            '_8_c' => $this->longText(),
            '_8_d_1' => $this->longText(),
            '_8_d_2' => $this->longText(),
            '_8_e_1' => $this->longText(),
            '_8_e_2' => $this->longText(),
            '_8_f_1' => $this->longText(),
            '_8_f_2' => $this->longText(),
            '_8_f_3' => $this->longText(),
            '_8_f_4' => $this->longText(),
            'progress' => $this->float()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);


        // LED PRODI KRITERIA 1-9 DETAIL
        $this->createTable('k9_lk_prodi_kriteria1_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria1' => $this->integer(),
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

        $this->createTable('k9_lk_prodi_kriteria2_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria2' => $this->integer(),
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

        $this->createTable('k9_lk_prodi_kriteria3_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria3' => $this->integer(),
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

        $this->createTable('k9_lk_prodi_kriteria4_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria4' => $this->integer(),
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

        $this->createTable('k9_lk_prodi_kriteria5_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria5' => $this->integer(),
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

        $this->createTable('k9_lk_prodi_kriteria6_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria6' => $this->integer(),
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

        $this->createTable('k9_lk_prodi_kriteria7_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria7' => $this->integer(),
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

        $this->createTable('k9_lk_prodi_kriteria8_detail', [
            'id' => $this->primaryKey(),
            'id_lk_prodi_kriteria8' => $this->integer(),
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
        $this->addForeignKey('fk-k9_lk_prodi-k9_akreditasi_prodi', '{{%k9_lk_prodi}}', 'id_akreditasi_prodi', '{{%k9_akreditasi_prodi}}', 'id', 'cascade', 'cascade');

        $this->addForeignKey('fk-k9_lk_prodi_kt1-k9_lk_prodi', '{{%k9_lk_prodi_kriteria1}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt2-k9_lk_prodi', '{{%k9_lk_prodi_kriteria2}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt3-k9_lk_prodi', '{{%k9_lk_prodi_kriteria3}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt4-k9_lk_prodi', '{{%k9_lk_prodi_kriteria4}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt5-k9_lk_prodi', '{{%k9_lk_prodi_kriteria5}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt6-k9_lk_prodi', '{{%k9_lk_prodi_kriteria6}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt7-k9_lk_prodi', '{{%k9_lk_prodi_kriteria7}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt8-k9_lk_prodi', '{{%k9_lk_prodi_kriteria8}}', 'id_lk_prodi', '{{%k9_lk_prodi}}', 'id', 'cascade', 'cascade');


        $this->addForeignKey('fk-k9_lk_prodi_kt1_detail-k9_lk_prodi_kt1', '{{%k9_lk_prodi_kriteria1_detail}}', 'id_lk_prodi_kriteria1', '{{%k9_lk_prodi_kriteria1}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt2_detail-k9_lk_prodi_kt2', '{{%k9_lk_prodi_kriteria2_detail}}', 'id_lk_prodi_kriteria2', '{{%k9_lk_prodi_kriteria2}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt3_detail-k9_lk_prodi_kt3', '{{%k9_lk_prodi_kriteria3_detail}}', 'id_lk_prodi_kriteria3', '{{%k9_lk_prodi_kriteria3}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt4_detail-k9_lk_prodi_kt4', '{{%k9_lk_prodi_kriteria4_detail}}', 'id_lk_prodi_kriteria4', '{{%k9_lk_prodi_kriteria4}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt5_detail-k9_lk_prodi_kt5', '{{%k9_lk_prodi_kriteria5_detail}}', 'id_lk_prodi_kriteria5', '{{%k9_lk_prodi_kriteria5}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt6_detail-k9_lk_prodi_kt6', '{{%k9_lk_prodi_kriteria6_detail}}', 'id_lk_prodi_kriteria6', '{{%k9_lk_prodi_kriteria6}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt7_detail-k9_lk_prodi_kt7', '{{%k9_lk_prodi_kriteria7_detail}}', 'id_lk_prodi_kriteria7', '{{%k9_lk_prodi_kriteria7}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt8_detail-k9_lk_prodi_kt8', '{{%k9_lk_prodi_kriteria8_detail}}', 'id_lk_prodi_kriteria8', '{{%k9_lk_prodi_kriteria8}}', 'id', 'cascade', 'cascade');


        $this->addForeignKey('fk-k9_lk_prodi_kt1_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria1_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt2_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria2_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt3_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria3_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt4_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria4_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt5_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria5_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt6_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria6_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt7_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria7_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt8_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria8_detail}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'cascade');


        $this->addForeignKey('fk-k9_lk_prodi_kt1_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria1_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt2_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria2_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt3_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria3_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt4_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria4_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt5_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria5_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt6_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria6_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt7_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria7_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');
        $this->addForeignKey('fk-k9_lk_prodi_kt8_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria8_detail}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'cascade');


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


        $this->dropTable('k9_lk_prodi_kriteria_9_detail');
        $this->dropTable('k9_lk_prodi_kriteria_8_detail');
        $this->dropTable('k9_lk_prodi_kriteria_7_detail');
        $this->dropTable('k9_lk_prodi_kriteria_6_detail');
        $this->dropTable('k9_lk_prodi_kriteria_5_detail');
        $this->dropTable('k9_lk_prodi_kriteria_4_detail');
        $this->dropTable('k9_lk_prodi_kriteria_3_detail');
        $this->dropTable('k9_lk_prodi_kriteria_2_detail');
        $this->dropTable('k9_lk_prodi_kriteria_1_detail');


        $this->dropTable('k9_lk_prodi_kriteria_9');
        $this->dropTable('k9_lk_prodi_kriteria_8');
        $this->dropTable('k9_lk_prodi_kriteria_7');
        $this->dropTable('k9_lk_prodi_kriteria_6');
        $this->dropTable('k9_lk_prodi_kriteria_5');
        $this->dropTable('k9_lk_prodi_kriteria_4');
        $this->dropTable('k9_lk_prodi_kriteria_3');
        $this->dropTable('k9_lk_prodi_kriteria_2');
        $this->dropTable('k9_lk_prodi_kriteria_1');


        $this->dropTable('{{%k9_lk_prodi}}');

        $this->dropTabelFakultas();
    }

    private function dropForeignProdi()
    {
        $this->dropForeignKey('fk-k9_lk_prodi-k9_akreditasi_prodi', '{{%k9_akreditasi_prodi}}');

        $this->dropForeignKey('fk-k9_lk_prodi_kt1-k9_lk_prodi', '{{%k9_lk_prodi_kriteria1}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt2-k9_lk_prodi', '{{%k9_lk_prodi_kriteria2}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt3-k9_lk_prodi', '{{%k9_lk_prodi_kriteria3}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt4-k9_lk_prodi', '{{%k9_lk_prodi_kriteria4}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt5-k9_lk_prodi', '{{%k9_lk_prodi_kriteria5}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt6-k9_lk_prodi', '{{%k9_lk_prodi_kriteria6}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt7-k9_lk_prodi', '{{%k9_lk_prodi_kriteria7}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt8-k9_lk_prodi', '{{%k9_lk_prodi_kriteria8}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt9-k9_lk_prodi', '{{%k9_lk_prodi_kriteria9}}');

        $this->dropForeignKey('fk-k9_lk_prodi_kt1_detail-k9_lk_prodi_kt1', '{{%k9_lk_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt2_detail-k9_lk_prodi_kt2', '{{%k9_lk_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt3_detail-k9_lk_prodi_kt3', '{{%k9_lk_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt4_detail-k9_lk_prodi_kt4', '{{%k9_lk_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt5_detail-k9_lk_prodi_kt5', '{{%k9_lk_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt6_detail-k9_lk_prodi_kt6', '{{%k9_lk_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt7_detail-k9_lk_prodi_kt7', '{{%k9_lk_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt8_detail-k9_lk_prodi_kt8', '{{%k9_lk_prodi_kriteria8_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt9_detail-k9_lk_prodi_kt9', '{{%k9_lk_prodi_kriteria9_detail}}');


        $this->dropForeignKey('fk-k9_lk_prodi_kt1_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt2_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt3_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt4_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt5_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt6_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt7_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt8_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria8_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt9_dtl_crd-usr_crd', '{{%k9_lk_prodi_kriteria9_detail}}');

        $this->dropForeignKey('fk-k9_lk_prodi_kt1_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria1_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt2_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria2_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt3_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria3_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt4_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria4_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt5_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria5_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt6_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria6_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt7_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria7_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt8_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria8_detail}}');
        $this->dropForeignKey('fk-k9_lk_prodi_kt9_dtl_upd-usr_upd', '{{%k9_lk_prodi_kriteria9_detail}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190723_094232_add_tabel_lk cannot be reverted.\n";

        return false;
    }
    */
}
