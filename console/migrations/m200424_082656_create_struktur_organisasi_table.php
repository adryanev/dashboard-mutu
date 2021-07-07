<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%struktur_organisasi}}`.
 */
class m200424_082656_create_struktur_organisasi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%struktur_organisasi}}', [
            'id' => $this->primaryKey(),
            'id_profil'=>$this->integer(),
            'parent'=>$this->integer(),
            'jabatan'=>$this->string(),
            'nama'=>$this->string(),
            'nipnik'=>$this->string(20),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);

        $this->addForeignKey('fk-struktur-profil','{{%struktur_organisasi}}','id_profil','{{%profil}}','id');
        $this->createIndex('idx-struktur-parent','{{%struktur_organisasi}}','parent');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-struktur-parent','{{%struktur_organisasi}}');
        $this->dropForeignKey('fk-struktur-profil','{{%struktur_organisasi}}');
        $this->dropTable('{{%struktur_organisasi}}');
    }
}
