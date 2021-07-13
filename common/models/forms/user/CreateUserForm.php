<?php


namespace common\models\forms\user;


use common\models\FakultasAkademi;
use common\models\ProfilUser;
use common\models\ProfilUserRole;
use common\models\ProgramStudi;
use common\models\Unit;
use common\models\User;
use InvalidArgumentException;
use Yii;
use yii\base\Model;
use yii\bootstrap\ActiveForm;
use yii\db\Exception;

class CreateUserForm extends Model
{

    public $username;
    public $password;
    public $email;
    public $status;
    public $hak_akses;

    public $nama_lengkap;
    public $tipe;
    public $id_fakultas;
    public $id_prodi;
    public $id_unit;
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
            'id_fakultas' => 'Fakultas',
            'id_prodi' => 'Prodi',
        ];
    }

    public function rules()
    {
        return [

            [['username', 'password', 'email', 'status', 'hak_akses', 'nama_lengkap',], 'required'],
            [['username'],'unique','targetClass' => User::class, 'message' => '{attribute} "{value}" telah digunakan.'],
            [['email'],'unique','targetClass' => User::class,'message' => '{attribute} "{value}" telah digunakan.'],
            [['username', 'password', 'email', 'hak_akses', 'nama_lengkap'], 'string'],
            [['id_fakultas', 'id_prodi','tipe','id_unit'], 'safe']
        ];
    }

    public function addUser()
    {
        $user = new User();
        $user->scenario = 'create';
        $profil = new ProfilUser();
        $user->setAttributes(['username' => $this->username,
            'email' => $this->email,
            'status' => $this->status,
        ]);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $profil->setAttributes(['nama_lengkap' => $this->nama_lengkap,], false);

        $transaction = Yii::$app->db->beginTransaction();


        if (!$user->save(false)) {
            $transaction->rollBack();
            return null;
        }
        $profil->id_user = $user->id;
        if (!$profil->save(false)) {
            $transaction->rollBack();
            return null;
        }

        $profilRole = new ProfilUserRole();
        $profilRole->id_profil = $profil->id;
        if($this->tipe === ProgramStudi::PROGRAM_STUDI){
            $profilRole->external_id = $this->id_prodi;
            $profilRole->type = ProgramStudi::PROGRAM_STUDI;
        }
        else if($this->tipe === FakultasAkademi::FAKULTAS_AKADEMI){
            $profilRole->external_id = $this->id_fakultas;
            $profilRole->type = FakultasAkademi::FAKULTAS_AKADEMI;
        }
        else if($this->tipe === Unit::UNIT){
            $profilRole->external_id = $this->id_unit;
            $profilRole->type = Unit::UNIT;
        }

        if(!$profilRole->save(false)){
            $transaction->rollBack();
            return null;
        }


        try {

            $auth = Yii::$app->getAuthManager();
            $role = $auth->getRole($this->hak_akses);

            try {
                $auth->assign($role, $user->id);
            } catch (\Exception $e) {
                $transaction->rollBack();
                return null;
            }

            $transaction->commit();
            return $user;

        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        return null;
    }

}