<?php

use yii\db\Migration;

/**
 * Class m190725_115230_add_first_admin
 */
class m190725_115230_add_first_admin extends Migration
{/**
 * {@inheritdoc}
 */
    public function safeUp()
    {

        $this->insert('{{%user}}',[
            'id'=>1,
            'username'=>'root',
            'auth_key'=>'Pwys0TRico7Ha4YSyX2fmjABrFskscxh',
            'password_hash'=>'$2y$13$tyy5A3UZe0ipSoaWDrbpXOfBE8bph0sawnVHrGu6RFfgD7Nihq9he',
            'password_reset_token'=>null,
            'email'=>'root@mutu.test',
            'status'=>10,
            'is_admin'=>1,
            'is_institusi'=>1,
            'is_fakultas'=>1,
            'is_prodi'=>1,
            'created_at'=>0,
            'updated_at'=>0,
            'verification_token'=>'Pwys0TRico7Ha4YSyX2fmjABrFskscxh'
        ]);

        $this->insert('{{%profil_user}}',[

            'id'=>1,
            'id_user'=>1,
            'nama_lengkap'=>'Administrator',
            'id_prodi'=>null,
            'created_at'=>0,
            'updated_at'=>0
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%profil_user}}',['id'=>1]);
        $this->delete('{{%user}}',['id'=>1]);

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190507_142701_add_first_admin cannot be reverted.\n";

        return false;
    }
    */
}
