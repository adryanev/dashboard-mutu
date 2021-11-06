<?php

namespace console\controllers;

use common\auth\rbac\rules\AccessOwnFakultas;
use common\auth\rbac\rules\AccessOwnProdi;
use common\auth\rbac\rules\AccessOwnUnit;
use common\auth\rbac\rules\AccessProdiAsesor;
use common\auth\rbac\rules\AccessPtAsesor;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class AuthController extends Controller
{

    public function actionUp()
    {
        $auth = Yii::$app->authManager;

        printf("Creating Roles\n");
        $superadmin = $auth->createRole('superadmin');
        $lpm = $auth->createRole('lpm');
        $rektorat = $auth->createRole('rektorat');
        $unit = $auth->createRole('unit');

        $prodi = $auth->createRole('prodi');
        $kaprodi = $auth->createRole('kaprodi');
        $asesor = $auth->createRole('asesor');

        $auth->add($superadmin);
        $auth->add($lpm);
        $auth->add($rektorat);
        $auth->add($unit);

        $auth->add($prodi);
        $auth->add($kaprodi);
        $auth->add($asesor);

        printf("Assigning SuperAdmin\n");
        $auth->assign($superadmin, 1);

        $su = $auth->getRole('superadmin');
        $suPermission = ['@dashboard-admin/*', '@dashboard-akreditasi/*'];

        foreach ($suPermission as $permission) {
            printf("Creating Permission: " . $permission . "\n");
            $permission = $auth->createPermission($permission);
            $auth->add($permission);
            printf("Assigning Permission to Roles \n");
            $auth->addChild($su, $permission);
            $auth->addChild($lpm, $permission);
        }
        $commonPermission = [
            '@dashboard-akreditasi/site/*',
            '@dashboard-akreditasi/profile/*',
            '@dashboard-akreditasi/kriteria9/default/*'
        ];

        $unitPermission = [
            '@dashboard-akreditasi/unit/arsip/*',
            '@dashboard-akreditasi/unit/kegiatan/*',
            '@dashboard-akreditasi/unit/default/*',
            '@dashboard-akreditasi/unit/profil/*',
            '@dashboard-akreditasi/unit/berkas/*'
        ];
        $isiLedProdiPermission = ['@dashboard-akreditasi/kriteria9/prodi/*',
         '@dashboard-akreditasi/kriteria9/k9-prodi/*'];
        $asesorPermission = ['@dashboard-akreditasi/asesor/*'];


        //common permission
        foreach ($commonPermission as $permission) {
            printf("Creating Permission: " . $permission . "\n");
            $permission = $auth->createPermission($permission);
            $auth->add($permission);
            printf("Assigning Permission to Roles \n");
            $auth->addChild($unit, $permission);
            $auth->addChild($prodi, $permission);
            $auth->addChild($asesor, $permission);
        }

        //unit permission
        foreach ($unitPermission as $permission) {
            printf("Creating Permission: " . $permission . "\n");
            $permission = $auth->createPermission($permission);
            $auth->add($permission);
            printf("Assigning Permission to Roles \n");
            $auth->addChild($unit, $permission);
        }

        //prodi permissions
        foreach ($isiLedProdiPermission as $permission) {
            printf("Creating Permission: " . $permission . "\n");
            $permission = $auth->createPermission($permission);
            $auth->add($permission);
            printf("Assigning Permission to Roles \n");
            $auth->addChild($prodi, $permission);
        }
        $auth->addChild($kaprodi, $prodi);


        //asesor permissions
        foreach ($asesorPermission as $permission) {
            printf("Creating Permission: " . $permission . "\n");
            $permission = $auth->createPermission($permission);
            $auth->add($permission);
            printf("Assigning Permission to Roles \n");
            $auth->addChild($asesor, $permission);
        }


        printf("create asesor rule");
        $accessProdiAsesor = new AccessProdiAsesor();

        $auth->add($accessProdiAsesor);

        print("create izin asesor permission");
        $izinProdiAsesor = $auth->createPermission('izinProdiAsesor');
        $izinProdiAsesor->description = "Access ke dalam pengisian prodi sebagai asesor";
        $izinProdiAsesor->ruleName = $accessProdiAsesor->name;
        $auth->add($izinProdiAsesor);


        //prodi rules
        printf("Create AccessOwnProdi Rule \n");
        $accessOwnProdi = new AccessOwnProdi;
        $auth->add($accessOwnProdi);
        printf("Create izinProdi Permission\n");
        $izinProdi = $auth->createPermission('izinProdi');
        $izinProdi->description = "Access kedalaman pengisian borang prodi";
        $izinProdi->ruleName = $accessOwnProdi->name;
        $auth->add($izinProdi);

        $prodiRoute = $auth->getPermission('@dashboard-akreditasi/kriteria9/k9-prodi/*');
        $prodiRoute2 = $auth->getPermission('@dashboard-akreditasi/kriteria9/prodi/*');
        printf("Adding izinProdi to Appropriate Roles\n");
        $auth->addChild($izinProdi, $prodiRoute);
        $auth->addChild($prodi, $izinProdi);

        printf("adding izinProdiAsesor to prodi permission");
        $auth->addChild($izinProdiAsesor, $prodiRoute);
        $auth->addChild($asesor, $izinProdiAsesor);
        $auth->addChild($izinProdiAsesor, $prodiRoute2);


        //unit rules
        printf("Create AccessOwnUnit Rule \n");
        $accessOwnUnit = new AccessOwnUnit;
        $auth->add($accessOwnUnit);
        printf("Create izinUnit Permission\n");
        $izinUnit = $auth->createPermission('izinUnit');
        $izinUnit->description = "Access kedalaman pengisian unit";
        $izinUnit->ruleName = $accessOwnUnit->name;
        $auth->add($izinUnit);

        $unitRoute1 = $auth->getPermission('@dashboard-akreditasi/unit/default/*');
        printf("Adding izinUnit to Appropriate Roles\n");
        $auth->addChild($izinUnit, $unitRoute1);
        $unitRoute2 = $auth->getPermission('@dashboard-akreditasi/unit/kegiatan/*');
        $auth->addChild($izinUnit, $unitRoute2);
        $unitRoute3 = $auth->getPermission('@dashboard-akreditasi/unit/profil/*');
        $auth->addChild($izinUnit, $unitRoute3);

        $auth->addChild($unit, $izinUnit);

        $auth->addChild($rektorat, $lpm);
        return ExitCode::OK;
    }

    public function actionDown()
    {
        $auth = Yii::$app->getAuthManager();
        printf("Removing all rbac authorization\n");
        $auth->removeAll();

        return ExitCode::OK;
    }
}
