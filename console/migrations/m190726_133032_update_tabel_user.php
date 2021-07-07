<?php

use yii\db\Migration;

/**
 * Class m190726_133032_update_tabel_user
 */
class m190726_133032_update_tabel_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('{{%user}}','is_admin');
        $this->dropColumn('{{%user}}','is_prodi');
        $this->dropColumn('{{%user}}','is_fakultas');
        $this->dropColumn('{{%user}}','is_institusi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%user}}','is_admin',$this->boolean());
        $this->addColumn('{{%user}}','is_prodi',$this->boolean());
        $this->addColumn('{{%user}}','is_fakultas',$this->boolean());
        $this->addColumn('{{%user}}','is_institusi',$this->boolean());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190726_133032_update_tabel_user cannot be reverted.\n";

        return false;
    }
    */
}
