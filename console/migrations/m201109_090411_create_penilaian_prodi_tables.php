<?php

use yii\db\Migration;

/**
 * Class m201109_090411_create_penilaian_prodi_tables
 */
class m201109_090411_create_penilaian_prodi_tables extends Migration
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

        $this->createTable('{{%k9_penilaian_prodi_eksternal}}', [
            'id' => $this->primaryKey(),
            'id_akreditasi_prodi' => $this->integer(),
            '_1' => $this->tinyInteger(),
            'total' => $this->integer()->defaultValue(0),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);
        $this->createTable('{{%k9_penilaian_prodi_profil}}', [
            'id' => $this->primaryKey(),
            'id_akreditasi_prodi' => $this->integer(),
            '_1' => $this->tinyInteger(),
            'total' => $this->integer()->defaultValue(0),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);
        $this->createTable('{{%k9_penilaian_prodi_kriteria}}', [
            'id' => $this->primaryKey(),
            'id_akreditasi_prodi' => $this->integer(),
            '_1_4_1' => $this->integer(),
            '_1_4_2' => $this->integer(),
            '_1_4_3' => $this->integer(),
            '_2_4_a' => $this->integer(),
            '_2_4_b' => $this->integer(),
            '_2_4_c' => $this->integer(),
            '_2_5_1' => $this->integer(),
            '_2_6_1' => $this->integer(),
            '_2_7_1' => $this->integer(),
            '_2_8_1' => $this->integer(),
            '_3_4_a_1' => $this->integer(),
            '_3_4_a_A' => $this->integer(),
            '_3_4_a_B' => $this->integer(),
            '_3_4_a_C' => $this->integer(),
            '_3_4_b_1' => $this->integer(),
            '_3_4_b_A' => $this->integer(),
            '_3_4_b_B' => $this->integer(),
            '_3_4_c_A' => $this->integer(),
            '_3_4_c_B' => $this->integer(),
            '_4_4_a_1' => $this->integer(),
            '_4_4_a_2' => $this->integer(),
            '_4_4_a_3' => $this->integer(),
            '_4_4_a_4' => $this->integer(),
            '_4_4_a_5' => $this->integer(),
            '_4_4_a_6' => $this->integer(),
            '_4_4_a_7' => $this->integer(),
            '_4_4_a_8' => $this->integer(),
            '_4_4_a_9' => $this->integer(),
            '_4_4_b_1' => $this->integer(),
            '_4_4_b_2' => $this->integer(),
            '_4_4_b_3' => $this->integer(),
            '_4_4_b_4' => $this->integer(),
            '_4_4_b_5' => $this->integer(),
            '_4_4_b_6' => $this->integer(),
            '_4_4_c_1' => $this->integer(),
            '_4_4_d_A' => $this->integer(),
            '_4_4_d_B' => $this->integer(),
            '_5_4_a_1' => $this->integer(),
            '_5_4_a_2' => $this->integer(),
            '_5_4_a_3' => $this->integer(),
            '_5_4_a_4' => $this->integer(),
            '_5_4_a_5' => $this->integer(),
            '_5_4_b_1' => $this->integer(),
            '_6_4_a_A' => $this->integer(),
            '_6_4_a_B' => $this->integer(),
            '_6_4_a_C' => $this->integer(),
            '_6_4_b_1' => $this->integer(),
            '_6_4_c_A' => $this->integer(),
            '_6_4_c_B' => $this->integer(),
            '_6_4_d_A' => $this->integer(),
            '_6_4_d_B' => $this->integer(),
            '_6_4_d_C' => $this->integer(),
            '_6_4_d_D' => $this->integer(),
            '_6_4_d_E' => $this->integer(),
            '_6_4_e_1' => $this->integer(),
            '_6_4_f_A' => $this->integer(),
            '_6_4_f_B' => $this->integer(),
            '_6_4_f_C' => $this->integer(),
            '_6_4_f_D' => $this->integer(),
            '_6_4_f_E' => $this->integer(),
            '_6_4_g_1' => $this->integer(),
            '_6_4_h_1' => $this->integer(),
            '_6_4_i_A' => $this->integer(),
            '_6_4_i_B' => $this->integer(),
            '_7_4_a_1' => $this->integer(),
            '_7_4_b_1' => $this->integer(),
            '_7_4_b_2' => $this->integer(),
            '_8_4_a_1' => $this->integer(),
            '_8_4_b_1' => $this->integer(),
            '_9_4_a_1' => $this->integer(),
            '_9_4_a_2' => $this->integer(),
            '_9_4_a_3' => $this->integer(),
            '_9_4_a_4' => $this->integer(),
            '_9_4_a_5' => $this->integer(),
            '_9_4_a_6' => $this->integer(),
            '_9_4_a_7' => $this->integer(),
            '_9_4_a_8' => $this->integer(),
            '_9_4_a_9' => $this->integer(),
            '_9_4_a_10' => $this->integer(),
            '_9_4_a_11' => $this->integer(),
            '_9_4_a_12' => $this->integer(),
            '_9_4_a_13' => $this->integer(),
            '_9_4_b_1' => $this->integer(),
            '_9_4_b_2' => $this->integer(),
            '_9_4_b_3' => $this->integer(),
            'total' => $this->integer()->defaultValue(0),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);
        $this->createTable('{{%k9_penilaian_prodi_analisis}}', [
            'id' => $this->primaryKey(),
            'id_akreditasi_prodi' => $this->integer(),
            '_1' => $this->integer(),
            '_2' => $this->integer(),
            '_3' => $this->integer(),
            '_4' => $this->integer(),
            'total' => $this->integer()->defaultValue(0),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-aprodi-penilai_eksternal',
            '{{%k9_penilaian_prodi_eksternal}}',
            'id_akreditasi_prodi',
            '{{%k9_akreditasi_prodi}}',
            'id',
            'cascade',
            'cascade'
        );
        $this->addForeignKey(
            'fk-aprodi-penilai_profil',
            '{{%k9_penilaian_prodi_profil}}',
            'id_akreditasi_prodi',
            '{{%k9_akreditasi_prodi}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-aprodi-penilai_kriteria',
            '{{%k9_penilaian_prodi_kriteria}}',
            'id_akreditasi_prodi',
            '{{%k9_akreditasi_prodi}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-aprodi-penilai_analisis',
            '{{%k9_penilaian_prodi_analisis}}',
            'id_akreditasi_prodi',
            '{{%k9_akreditasi_prodi}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-usr_crd-penilai_eksternal',
            '{{%k9_penilaian_prodi_eksternal}}',
            'created_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );
        $this->addForeignKey(
            'fk-usr_crd-penilai_profil',
            '{{%k9_penilaian_prodi_profil}}',
            'created_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-usr_crd-penilai_kriteria',
            '{{%k9_penilaian_prodi_kriteria}}',
            'created_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-usr_crd-penilai_analisis',
            '{{%k9_penilaian_prodi_analisis}}',
            'created_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-usr_upd-penilai_eksternal',
            '{{%k9_penilaian_prodi_eksternal}}',
            'updated_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );
        $this->addForeignKey(
            'fk-usr_upd-penilai_profil',
            '{{%k9_penilaian_prodi_profil}}',
            'updated_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-usr_upd-penilai_kriteria',
            '{{%k9_penilaian_prodi_kriteria}}',
            'updated_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'fk-usr_upd-penilai_analisis',
            '{{%k9_penilaian_prodi_analisis}}',
            'updated_by',
            '{{%user}}',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-aprodi-penilai_eksternal',
            '{{%k9_penilaian_prodi_eksternal}}'
        );
        $this->dropForeignKey(
            'fk-aprodi-penilai_profil',
            '{{%k9_penilaian_prodi_profil}}'
        );

        $this->dropForeignKey(
            'fk-aprodi-penilai_kriteria',
            '{{%k9_penilaian_prodi_kriteria}}'
        );

        $this->dropForeignKey(
            'fk-aprodi-penilai_analisis',
            '{{%k9_penilaian_prodi_analisis}}'
        );

        $this->dropForeignKey(
            'fk-usr_crd-penilai_eksternal',
            '{{%k9_penilaian_prodi_eksternal}}'
        );
        $this->dropForeignKey(
            'fk-usr_crd-penilai_profil',
            '{{%k9_penilaian_prodi_profil}}'
        );

        $this->dropForeignKey(
            'fk-usr_crd-penilai_kriteria',
            '{{%k9_penilaian_prodi_kriteria}}'
        );

        $this->dropForeignKey(
            'fk-usr_crd-penilai_analisis',
            '{{%k9_penilaian_prodi_analisis}}'
        );

        $this->dropForeignKey(
            'fk-usr_upd-penilai_eksternal',
            '{{%k9_penilaian_prodi_eksternal}}'
        );
        $this->dropForeignKey(
            'fk-usr_upd-penilai_profil',
            '{{%k9_penilaian_prodi_profil}}'
        );

        $this->dropForeignKey(
            'fk-usr_upd-penilai_kriteria',
            '{{%k9_penilaian_prodi_kriteria}}'
        );

        $this->dropForeignKey(
            'fk-usr_upd-penilai_analisis',
            '{{%k9_penilaian_prodi_analisis}}'
        );

        $this->dropTable('{{%k9_penilaian_prodi_eksternal}}');
        $this->dropTable('{{%k9_penilaian_prodi_profil}}');
        $this->dropTable('{{%k9_penilaian_prodi_kriteria}}');
        $this->dropTable('{{%k9_penilaian_prodi_analisis}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201109_090411_create_penilaian_prodi_tables cannot be reverted.\n";

        return false;
    }
    */
}
