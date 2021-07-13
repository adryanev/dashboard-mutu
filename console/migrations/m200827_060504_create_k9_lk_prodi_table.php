<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%k9_lk_prodi}}`.
 */
class m200827_060504_create_k9_lk_prodi_table extends Migration
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
        $this->createTable('{{%k9_lk_prodi_kriteria1}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%k9_lk_prodi_kriteria2}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%k9_lk_prodi_kriteria3}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%k9_lk_prodi_kriteria4}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%k9_lk_prodi_kriteria5}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%k9_lk_prodi_kriteria6}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%k9_lk_prodi_kriteria7}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%k9_lk_prodi_kriteria8}}', [
            'id' => $this->primaryKey(),
            'id_lk_prodi'=>$this->integer(),
            'progress_narasi'=>$this->float(),
            'progress_dokumen'=>$this->float(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);

        $this->addForeignKey('fk-k9_lk_prod_k_1-lk_prod','{{%k9_lk_prodi_kriteria1}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k_2-lk_prod','{{%k9_lk_prodi_kriteria2}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k_3-lk_prod','{{%k9_lk_prodi_kriteria3}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k_4-lk_prod','{{%k9_lk_prodi_kriteria4}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k_5-lk_prod','{{%k9_lk_prodi_kriteria5}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k_6-lk_prod','{{%k9_lk_prodi_kriteria6}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k_7-lk_prod','{{%k9_lk_prodi_kriteria7}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');
        $this->addForeignKey('fk-k9_lk_prod_k_8-lk_prod','{{%k9_lk_prodi_kriteria8}}','id_lk_prodi','{{%k9_lk_prodi}}','id','cascade','cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-k9_lk_prod_k_1-lk_prod','{{%k9_lk_prodi_kriteria1}}');
        $this->dropForeignKey('fk-k9_lk_prod_k_2-lk_prod','{{%k9_lk_prodi_kriteria2}}');
        $this->dropForeignKey('fk-k9_lk_prod_k_3-lk_prod','{{%k9_lk_prodi_kriteria3}}');
        $this->dropForeignKey('fk-k9_lk_prod_k_4-lk_prod','{{%k9_lk_prodi_kriteria4}}');
        $this->dropForeignKey('fk-k9_lk_prod_k_5-lk_prod','{{%k9_lk_prodi_kriteria5}}');
        $this->dropForeignKey('fk-k9_lk_prod_k_6-lk_prod','{{%k9_lk_prodi_kriteria6}}');
        $this->dropForeignKey('fk-k9_lk_prod_k_7-lk_prod','{{%k9_lk_prodi_kriteria7}}');
        $this->dropForeignKey('fk-k9_lk_prod_k_8-lk_prod','{{%k9_lk_prodi_kriteria8}}');

        $this->dropTable('{{%k9_lk_prodi_kriteria1}}');
        $this->dropTable('{{%k9_lk_prodi_kriteria2}}');
        $this->dropTable('{{%k9_lk_prodi_kriteria3}}');
        $this->dropTable('{{%k9_lk_prodi_kriteria4}}');
        $this->dropTable('{{%k9_lk_prodi_kriteria5}}');
        $this->dropTable('{{%k9_lk_prodi_kriteria6}}');
        $this->dropTable('{{%k9_lk_prodi_kriteria7}}');
        $this->dropTable('{{%k9_lk_prodi_kriteria8}}');
    }
}
