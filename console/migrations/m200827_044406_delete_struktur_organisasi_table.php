<?php

use yii\db\Migration;

/**
 * Class m200827_044406_delete_struktur_organisasi_table
 */
class m200827_044406_delete_struktur_organisasi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropIndex('idx-struktur-parent','{{%struktur_organisasi}}');
        $this->dropForeignKey('fk-struktur-profil','{{%struktur_organisasi}}');
        $this->dropTable('{{%struktur_organisasi}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200827_044406_delete_struktur_organisasi_table cannot be reverted.\n";

        return false;
    }
    */
}
