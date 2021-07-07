<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kegiatan_unit}}`.
 */
class m190913_074438_create_kegiatan_unit_table extends Migration
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
        $this->createTable('{{%kegiatan_unit}}', [
            'id' => $this->primaryKey(),
            'id_unit'=>$this->integer(),
            'nama'=>$this->string(),
            'deskripsi'=>$this->text(),
            'waktu_mulai'=>$this->integer(),
            'waktu_selesai'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
        $this->addForeignKey('fk-kegiatan_unit-unit','{{%kegiatan_unit}}','id_unit','{{%unit}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kegiatan_unit}}');
    }
}
