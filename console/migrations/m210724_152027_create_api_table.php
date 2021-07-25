<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%api}}`.
 */
class m210724_152027_create_api_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%api}}', [
            'id' => $this->primaryKey(),
            'nama'=> $this->string(),
            'access_token'=>$this->string(64),
            'auth_key'=>$this->string(32),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%api}}');
    }
}
