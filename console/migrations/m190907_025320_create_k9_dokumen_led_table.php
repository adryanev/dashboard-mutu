<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%k9_dokumen_led}}`.
 */
class m190907_025320_create_k9_dokumen_led_table extends Migration
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



        $this->createTable('{{%k9_dokumen_led_prodi}}', [
            'id' => $this->primaryKey(),
            'id_led_prodi' => $this->integer(),
            'nama_dokumen' => $this->string(),
            'bentuk_dokumen' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ], $tableOptions);



        $this->addForeignKey('fk-k9_dokumen_led_prod-k9_led_prod', '{{%k9_dokumen_led_prodi}}', 'id_led_prodi', '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%k9_dokumen_led_prodi}}');
    }
}
