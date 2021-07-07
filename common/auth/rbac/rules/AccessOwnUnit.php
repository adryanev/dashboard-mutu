<?php


namespace common\auth\rbac\rules;


use common\models\AuthAssignment;
use common\models\Unit;
use common\models\User;
use yii\rbac\Rule;

class AccessOwnUnit extends Rule
{

    public $name = 'accessOwnUnit';

    public function execute($user, $item, $params)
    {
        $identity = User::findOne($user);
        if(!$identity) {
            return false;
        }
        if(isset($params['unit'])){
            $unit = Unit::findOne($params['unit']);
            if(!$unit) {
                return false;
            }

            $role = AuthAssignment::findOne(['user_id'=>$identity->id]);
            if(!$role) {
                return false;
            }

            if($role->item_name === 'superadmin' || $role->item_name === 'lpm'){
                return true;
            }
            return $identity->profilUser->unit->id === $unit->id;
        }

        return false;
    }
}
