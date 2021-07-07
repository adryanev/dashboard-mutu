<?php


namespace common\auth\rbac\rules;


use common\models\AuthAssignment;
use common\models\ProgramStudi;
use common\models\User;
use yii\rbac\Rule;

class AccessOwnProdi extends Rule
{
    public $name = "accessOwnProdi";

    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {

        if(isset($params['prodi'])){


            $identity = User::findOne($user);
            if(!$identity){
                return false;
            }
            $role = AuthAssignment::findOne(['user_id'=>$user]);
            if(!$role) {
                return false;
            }
            if ($role->item_name === 'superadmin'||$role->item_name ==='lpm') {
                return true;
            }

            if ($role->item_name === 'prodi' || $role->item_name === 'kaprodi') {
                $prodiParam = ProgramStudi::findOne($params['prodi']);
                if(!$prodiParam) return false;
                $prodi =$identity->profilUser->prodi;
                return $prodi->id === $prodiParam->id;
            }

            if($role->item_name === 'fakultas'|| $role->item_name==='dekanat') {
                $fakultas = $identity->profilUser->fakultas;
                $prodis = $fakultas->getProgramStudis()->andWhere(['id'=>$params['prodi']])->one();
                return $prodis? true: false;
            }
        }
        return false;
    }
}
