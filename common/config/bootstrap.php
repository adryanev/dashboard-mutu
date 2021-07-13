<?php
Yii::setAlias('@root',dirname(__DIR__,2));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@akreditasi', dirname(dirname(__DIR__)) . '/akreditasi');
Yii::setAlias('@admin', dirname(dirname(__DIR__)) . '/admin');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@uploadAkreditasi', '@common/storages/upload');
Yii::setAlias('@uploadAdmin', '@common/storages/upload');
Yii::setAlias('@uploadStruktur', '@uploadAkreditasi/struktur');
Yii::setAlias('@required', '@common/required');
Yii::setAlias('@uploadUnit', '@common/storages/upload/unit/{id_unit}');
Yii::setAlias('@uploadFakultas', '@common/storages/upload/fakultas/{id_fakultas}');
Yii::setAlias('@uploadInstitusi', '@common/storages/upload/institusi');
$ini = parse_ini_file(dirname(__DIR__, 2) . '/system-configuration.ini');

Yii::setAlias('@.akreditasi', $ini['url_kriteria']);
Yii::setAlias('@.admin', $ini['url_admin']);
Yii::setAlias('@.uploadAkreditasi', '@.akreditasi/upload');
Yii::setAlias('@.uploadAdmin', '@.admin/upload');
Yii::setAlias('@.uploadStruktur', '@.uploadAkreditasi/struktur');
Yii::setAlias('@.uploadUnit', '@.akreditasi/upload/unit/{id_unit}');
Yii::setAlias('@.uploadFakultas', '@.akreditasi/upload/fakultas/{id_fakultas}');
Yii::setAlias('@.uploadInstitusi', '@.akreditasi/upload/institusi');
