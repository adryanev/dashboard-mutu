<?php

namespace common\modules\profile\controllers;


use common\models\forms\user\UpdatePasswordForm;
use common\models\forms\user\UpdateAccountForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Default controller for the `profile` module
 */
class AccountController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    ['actions'=>['edit-account','change-password'],
                        'allow'=>true,
                        'roles'=>['@']
                    ]
                ]
            ],
        ];
    }

    public function actionEditAccount()
    {

        $id = Yii::$app->user->getId();
        $model = new UpdateAccountForm($id);

        if ($model->load(Yii::$app->request->post()) ) {
            if(!$model->validate()){
                throw new InvalidArgumentException('Gagal validasi pengguna');
            }
            $model->updateUser();
            if($model === false){
                throw new InvalidArgumentException('Gagal memperbarui pengguna, terdapat error');

            }

            Yii::$app->session->setFlash('success','Berhasil memperbarui pengguna');

            return $this->redirect(['default/index']);
        }

        return $this->render('edit-account',[
            'model' => $model,
        ]);
    }

    public function actionChangePassword()
    {
        $id = Yii::$app->user->getId();
        $modelPassword = new UpdatePasswordForm($id);

        if($modelPassword->load(Yii::$app->request->post())){

            if($modelPassword->validate()){
                $modelPassword->updatePassword();
                if(!$modelPassword){
                    throw new InvalidArgumentException('Gagal mengganti kata sandi');
                }
                Yii::$app->session->setFlash('success','Berhasil mengganti kata sandi');
                return $this->redirect(['default/index']);
            }

        }
        return $this->render('change-password',[
            'modelPassword'=>$modelPassword,

        ]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */



}
