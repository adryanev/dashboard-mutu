<?php

use Carbon\Carbon;
use yii\db\Migration;

/**
 * Class m210724_152624_add_bimas_api
 */
class m210724_152624_add_bimas_api extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%api}}',[
            'nama'=>'Bimas',
            'auth_key'=>Yii::$app->security->generateRandomString(),
            'access_token'=>Yii::$app->security->generateRandomString(),
            'created_at'=> Carbon::now()->timestamp,
            'updated_at'=> Carbon::now()->timestamp
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(1);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210724_152624_add_bimas_api cannot be reverted.\n";

        return false;
    }
    */
}
