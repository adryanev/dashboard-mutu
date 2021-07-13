<?php

use yii\db\Migration;

/**
 * Class m210113_091604_alter_ekspor_dokumen_to_polymorph
 */
class m210113_091604_alter_ekspor_dokumen_to_polymorph extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        //prodi
        $this->dropForeignKey('fk-k9_dokumen_led_prod-k9_led_prod', '{{%k9_prodi_ekspor_dokumen}}');
        $this->renameColumn('{{%k9_prodi_ekspor_dokumen}}', 'id_led_prodi', 'external_id');
        $this->addColumn('{{%k9_prodi_ekspor_dokumen}}', 'type', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //prodi
        $this->renameColumn('{{%k9_prodi_ekspor_dokumen}}', 'external_id', 'id_led_prodi');
        $this->addForeignKey('fk-k9_dokumen_led_prod-k9_led_prod', '{{%k9_prodi_ekspor_dokumen}}', 'id_led_prodi',
            '{{%k9_led_prodi}}', 'id', 'cascade', 'cascade');
        $this->dropColumn('{{%k9_prodi_ekspor_dokumen}}', 'type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210113_091604_alter_ekspor_dokumen_to_polymorph cannot be reverted.\n";

        return false;
    }
    */
}
