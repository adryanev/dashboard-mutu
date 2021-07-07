<?php

use yii\db\Migration;

/**
 * Class m210205_082955_add_sumber_kuantitatif_ke_prodi_dan_institusi
 */
class m210205_082955_add_sumber_kuantitatif_ke_prodi_dan_institusi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%k9_data_kuantitatif_prodi}}', 'sumber');
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%k9_data_kuantitatif_prodi}}', 'sumber', $this->string());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210205_082955_add_sumber_kuantitatif_ke_prodi_dan_institusi cannot be reverted.\n";

        return false;
    }
    */
}
