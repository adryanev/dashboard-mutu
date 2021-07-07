<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_role}}`.
 */
class m200507_080417_create_profil_user_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_role-user', '{{%user_role}}');
        $this->dropTable('{{%profil_user_role}}');
    }

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
        $this->createTable('{{%profil_user_role}}', [
            'id' => $this->primaryKey(),
            'id_profil' => $this->integer(),
            'external_id' => $this->integer(),
            'type' => $this->string(15)
        ], $tableOptions);

        $this->addForeignKey('fk-profil_user_role-user', '{{%profil_user_role}}', 'id_profil', '{{%profil_user}}', 'id',
            'cascade', 'cascade');

    }
}
