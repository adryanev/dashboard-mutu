<?php

use yii\db\Migration;

/**
 * Class m190726_190137_add_progress_to_aps_apt
 */
class m190726_190137_add_progress_to_aps_apt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%k9_akreditasi_prodi}}','progress',$this->float()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%k9_akreditasi_prodi}}','progress');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190726_190137_add_progress_to_aps_apt cannot be reverted.\n";

        return false;
    }
    */
}
