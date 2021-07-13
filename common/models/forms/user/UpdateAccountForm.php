<?php

namespace common\models\forms\user;

use common\models\ProfilUser;
use common\models\User;
use InvalidArgumentException;
use Yii;
use yii\db\Exception;

class UpdateAccountForm extends \yii\base\Model
{
    public $username;
    public $email;
    public $nama_lengkap;


    /**
     * @var User
     */
    private $_user;

    /**
     * @var ProfilUser
     */
    private $_profilUser;

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
        ];
    }

    public function __construct($id, $config = [])
    {

        if (empty($id)) {
            throw new InvalidArgumentException('Id tidak boleh kosong');
        }
        $this->_user = User::findOne($id);
        if (!$this->_user) {
            throw new InvalidArgumentException('User tidak Ditemukan');
        }
        $this->_profilUser = $this->_user->profilUser;

        $this->setAttributes([
            'username' => $this->_user->username,
            'email' => $this->_user->email,
            'nama_lengkap' => $this->_profilUser->nama_lengkap,
        ], false);


        parent::__construct($config);
    }

    public function rules(): array
    {
        return [

            [['username', 'email', 'nama_lengkap'], 'required'],
        ];
    }

    public function updateUser()
    {

        $user = $this->_user;
        $user->scenario = 'update-account';

        $profil = $this->_profilUser;

        $user->setAttributes(['username' => $this->username,
            'email' => $this->email,
        ]);

        $profil->setAttributes(['nama_lengkap' => $this->nama_lengkap]);

        $transaction = \Yii::$app->db->beginTransaction();


        try {
            if (!$user->save(false)) {
                $transaction->rollBack();
                return false;
            }
            $profil->id_user = $user->id;
            if (!$profil->save(false)) {
                $transaction->rollBack();
                return false;
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }


        return $user;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getProfilUser()
    {
        return $this->_profilUser;
    }
}