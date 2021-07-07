<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kegiatan_unit_detail}}`.
 */
class m190913_074456_create_kegiatan_unit_detail_table extends Migration
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
        $this->createTable('{{%kegiatan_unit_detail}}', [
            'id' => $this->primaryKey(),
            'id_kegiatan_unit' => $this->integer(),
            'nama_file' => $this->string(),
            'isi_file' => $this->string(),
            'jenis_file' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);
        $this->addForeignKey('fk-kegiatan_unit_detail-kegiatan_unit', '{{%kegiatan_unit_detail}}', 'id_kegiatan_unit', '{{%kegiatan_unit}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kegiatan_unit_detail}}');
    }
}
