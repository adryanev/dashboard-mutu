<?php
namespace admin\controllers;

use common\models\kriteria9\akreditasi\K9AkreditasiInstitusi;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\ProgramStudi;
use common\models\User;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

//        $year = date('Y');
//        $jumlahProdi = ProgramStudi::find()->count();
//        $jumlahPengguna = User::find()->count();
//        $aps = K9AkreditasiProdi::find()->joinWith(['akreditasi'])->where(['k9_akreditasi.tahun'=>$year])->count();
//
//        $apsTahunIni = $aps;
//        $progressAps = 0;
//        $totalProgressAps = $aps *100;
//        $semuaApsTahunIni =K9AkreditasiProdi::find()->joinWith(['akreditasi'])->where(['k9_akreditasi.tahun'=>$year])->all();
//
//        foreach ($semuaApsTahunIni as $apsIni){
//            $progressAps += $apsIni->progress;
//        }
//
//        try{
//            $persenAps = ($progressAps/$totalProgressAps) * 100;
//
//        } catch (ErrorException $e){
//            $persenAps = 0;
//        }
//        $apt = K9AkreditasiInstitusi::find()->joinWith(['akreditasi'])->where(['k9_akreditasi.tahun'=>$year])->count();
//
//        $persenApt = 0;
//
//        $aptTahunIni =K9AkreditasiInstitusi::find()->joinWith(['akreditasi'])->where(['k9_akreditasi.tahun'=>$year])->one();
//
//        if($aptTahunIni) $persenApt = $aptTahunIni->progress;


        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
