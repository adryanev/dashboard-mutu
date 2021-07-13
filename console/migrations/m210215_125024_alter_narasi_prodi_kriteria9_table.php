<?php

use yii\db\Migration;

/**
 * Class m210215_125024_alter_narasi_prodi_kriteria9_table
 */
class m210215_125024_alter_narasi_prodi_kriteria9_table extends Migration
{
    use \common\helpers\TextTypesTrait;

    private $tableName = '{{%k9_led_prodi_narasi_kriteria9}}';

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->addColumn($this->tableName, '_9_1', $this->longText());
        $this->addColumn($this->tableName, '_9_2', $this->longText());
        $this->addColumn($this->tableName, '_9_3', $this->longText());
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn($this->tableName, '_9_1');
        $this->dropColumn($this->tableName, '_9_2');
        $this->dropColumn($this->tableName, '_9_3');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210215_125024_alter_narasi_prodi_kriteria9_table cannot be reverted.\n";

        return false;
    }
    */
}
