<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%detail_berkas}}`.
 */
class m200511_134302_create_detail_berkas_table extends Migration
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
        $this->createTable('{{%detail_berkas}}', [
            'id' => $this->primaryKey(),
            'id_berkas'=>$this->integer(),
            'isi_berkas'=>$this->string(),
            'bentuk_berkas'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->addForeignKey('fk-detail_berkas-berkas','{{%detail_berkas}}','id_berkas','{{%berkas}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-detail_berkas-berkas','{{%detail_berkas}}');
        $this->dropTable('{{%detail_berkas}}');
    }
}
