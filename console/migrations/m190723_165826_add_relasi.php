<?php

use yii\db\Migration;

/**
 * Class m190723_165826_add_relasi
 */
class m190723_165826_add_relasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addForeignKey('fk-profil_user-user','{{%profil_user}}','id_user', 'user','id','cascade','cascade');
        $this->addForeignKey('fk-profil_user-program_studi','{{%profil_user}}','id_prodi', 'program_studi','id','cascade','cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-profil_user-program_studi','{{%profil_user}}');
        $this->dropForeignKey('fk-profil_user-user','{{%profil_user}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190723_165826_add_relasi cannot be reverted.\n";

        return false;
    }
    */
}
