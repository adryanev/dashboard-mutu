<?php


namespace common\auth\rbac\rules;

use common\models\AuthAssignment;
use common\models\FakultasAkademi;
use common\models\User;
use yii\rbac\Item;
use yii\rbac\Rule;

class AccessOwnFakultas extends Rule
{
    public $name= 'accessOwnFakultas';

    /**
     * @param int|string $user
     * @param Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        $identity = User::findOne($user);
        if (!$identity) {
            return false;
        }
        if (isset($params['fakultas'])) {
            $fakultas = FakultasAkademi::findOne($params['fakultas']);
            if (!$fakultas) {
                return false;
            }

            $role = AuthAssignment::findOne(['user_id'=>$identity->id]);
            if (!$role) {
                return false;
            }

            if ($role->item_name === 'superadmin' || $role->item_name === 'lpm') {
                return true;
            }

            if ($role->item_name === 'fakultas' || $role->item_name === 'dekanat') {
                return $identity->profilUser->fakultas->id === $fakultas->id;
            }
        }
        return false;
    }
}
