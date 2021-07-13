<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%berkas}}`.
 */
class m200511_134254_create_berkas_table extends Migration
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
        $this->createTable('{{%berkas}}', [
            'id' => $this->primaryKey(),
            'external_id'=>$this->integer(),
            'type'=>$this->string(),
            'nama_berkas'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%berkas}}');
    }
}
