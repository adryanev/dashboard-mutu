<?php


namespace common\auth\rbac\rules;


use common\models\AsesorRequest;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Rule;

class AccessPtAsesor extends Rule
{

    public $name = 'AccessPtAsesor';

    /**
     * @param int|string $user
     * @param Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        $roles = \Yii::$app->authManager->getRolesByUser($user);

        $rolesMap = ArrayHelper::getValue($roles, 'asesor');

        if ($rolesMap === null) {
            return false;
        }

        $request = AsesorRequest::find()->where(['id_asesor' => $user, 'id_prodi' => null, 'izinkan' => true])->one();
        if (!$request) {
            return false;
        }

        return true;
    }
}
