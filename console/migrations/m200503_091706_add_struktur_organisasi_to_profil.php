<?php

use yii\db\Migration;

/**
 * Class m200503_091706_add_struktur_organisasi_to_profil
 */
class m200503_091706_add_struktur_organisasi_to_profil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%profil}}','struktur_organisasi',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%profil}}','struktur_organisasi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_091706_add_struktur_organisasi_to_profil cannot be reverted.\n";

        return false;
    }
    */
}
