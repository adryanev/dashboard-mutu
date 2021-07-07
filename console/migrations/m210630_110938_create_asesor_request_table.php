<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asesor_request}}`.
 */
class m210630_110938_create_asesor_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asesor_request}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%asesor_request}}', [
            'id' => $this->primaryKey(),
            'id_asesor' => $this->integer()->notNull(),
            'izinkan' => $this->boolean(),
            'id_prodi' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-asesor-user', '{{%asesor_request}}', 'id_asesor', '{{%user}}', 'id', 'cascade',
            'cascade');
        $this->addForeignKey('fk-asesor-prodi', '{{%asesor_request}}', 'id_prodi', '{{%program_studi}}', 'id',
            'cascade', 'cascade');

        $this->createIndex('idx-asesor-id_asesor', '{{%asesor_request}}', 'id_asesor');
        $this->createIndex('idx-asesor-izinkan', '{{%asesor_request}}', 'izinkan');
        $this->createIndex('idx-asesor-id_prodi', '{{%asesor_request}}', 'id_prodi');

    }
}
