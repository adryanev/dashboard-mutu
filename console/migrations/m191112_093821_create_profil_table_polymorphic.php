<?php

use yii\db\Migration;

/**
 * Class m191112_093821_create_profil_table_polymorphic
 */
class m191112_093821_create_profil_table_polymorphic extends Migration
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

        $this->createTable('{{%profil}}', [
            'id' => $this->primaryKey(),
            'external_id' => $this->integer(),
            'type' => $this->string(),
            'visi' => $this->string(),
            'misi' => $this->string(),
            'tujuan' => $this->string(),
            'sasaran' => $this->string(),
            'motto' => $this->string(),
            'sambutan' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profil}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191112_093821_create_profil_table_polymorphic cannot be reverted.\n";

        return false;
    }
    */
}
