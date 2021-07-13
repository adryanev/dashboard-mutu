<?php

use yii\db\Migration;

/**
 * Class m191012_123659_update_unit_table
 */
class m191012_123659_update_unit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%unit}}', 'jenis', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%unit}}', 'jenis');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191012_123659_update_unit_table cannot be reverted.\n";

        return false;
    }
    */
}
