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
use yii\db\Exception;

class UpdateUserForm extends Model
{


    public $username;
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

    /**
     * @var ProfilUserRole
     */
    private $_profileRole;

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'id_fakultas' => 'Fakultas',
            'id_prodi' => 'Prodi',
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
        $this->_profileRole = $this->_profilUser->profilUserRole;

        $this->setAttributes([
            'username' => $this->_user->username,
            'email' => $this->_user->email,
            'status' => $this->_user->status,
            'nama_lengkap' => $this->_profilUser->nama_lengkap,
        ], false);

        if($this->_profileRole->type === ProgramStudi::PROGRAM_STUDI){
            $this->tipe = ProgramStudi::PROGRAM_STUDI;
            $this->id_prodi = $this->_profileRole->external_id;
        }
        elseif ($this->_profileRole->type === FakultasAkademi::FAKULTAS_AKADEMI){
            $this->tipe = FakultasAkademi::FAKULTAS_AKADEMI;
            $this->id_fakultas = $this->_profileRole->external_id;
        }
        elseif ($this->_profileRole->type === Unit::UNIT){
            $this->tipe = Unit::UNIT;
            $this->id_unit = $this->_profileRole->external_id;
        }

        $auth = Yii::$app->getAuthManager();
        $r = array_keys($auth->getRolesByUser($this->_user->id));
        $akses = array_combine($r, $r);
        $this->hak_akses = $akses;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [

            [['username', 'email', 'status', 'hak_akses', 'nama_lengkap'], 'required'],
            [['username'],'unique','targetClass' => User::class, 'message' => '{attribute} "{value}" telah digunakan.'],
            [['email'],'unique','targetClass' => User::class,'message' => '{attribute} "{value}" telah digunakan.'],
            [['username', 'email', 'hak_akses', 'nama_lengkap'], 'string'],
            [['id_fakultas', 'id_prodi','tipe','id_unit'], 'safe']
        ];
    }

    public function updateUser()
    {

        $user = $this->_user;
        $user->scenario = 'update';

        $profil = $this->_profilUser;

        $profilRole = $this->_profileRole;

        $user->setAttributes(['username' => $this->username,
            'email' => $this->email,
            'status' => $this->status,
        ], false);
        $profil->setAttributes(['nama_lengkap' => $this->nama_lengkap]);

        $transaction = \Yii::$app->db->beginTransaction();

        if (!$user->save(false)) {
            $transaction->rollBack();
            return false;
        }
        if (!$profil->save(false)) {
            $transaction->rollBack();
            return false;
        }
        $tipe = null;
        switch ($this->tipe){
            case ProgramStudi::PROGRAM_STUDI: $tipe =  ProgramStudi::PROGRAM_STUDI; break;
            case FakultasAkademi::FAKULTAS_AKADEMI: $tipe =  FakultasAkademi::FAKULTAS_AKADEMI; break;
            case Unit::UNIT : $tipe = Unit::UNIT; break;
        }
        $id = null;
        switch ($this->tipe){
            case ProgramStudi::PROGRAM_STUDI: $id = $this->id_prodi; break;
            case FakultasAkademi::FAKULTAS_AKADEMI: $id = $this->id_fakultas; break;
            case Unit::UNIT : $id = $this->id_unit;break;
        }
        $profilRole->setAttributes(['type'=>$tipe,
            'external_id'=>$id],false);

        if(!$profilRole->save(false)){
            $transaction->rollBack();
            return null;
        }


        try {
            $auth = Yii::$app->getAuthManager();
            $r = array_values($auth->getRolesByUser($user->id));
            foreach ($r as $role) {
                $auth->revoke($role, $user->id);

            }
            $role = $auth->getRole($this->hak_akses);

            try {
                $auth->assign($role, $user->id);
            } catch (\Exception $e) {
                $transaction->rollBack();
                return false;
            }
            $transaction->commit();

        } catch (Exception $e) {
            var_dump($e->getMessage());
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

    public function getProfileRole(){
        return $this->_profileRole;
    }
}