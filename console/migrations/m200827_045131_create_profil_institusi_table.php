<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profil_institusi}}`.
 */
class m200827_045131_create_profil_institusi_table extends Migration
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
        $this->createTable('{{%profil_institusi}}', [
            'id' => $this->primaryKey(),
            'nama'=>$this->string(),
            'isi'=>$this->text(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profil_institusi}}');
    }
}
