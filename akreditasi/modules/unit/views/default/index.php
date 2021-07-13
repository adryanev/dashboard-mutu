<?php

/* @var $unit Unit */
/* @var $profil common\models\Profil */

use common\models\Unit;
use yii\bootstrap4\Html;

$this->title = $unit->nama;


?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Profil Unit
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">

                    <?= Html::a('<i class=flaticon2-edit></i> Edit', ['profil/index', 'unit' => Yii::$app->request->get('unit')], ['class' => 'btn btn-info btn-elevate btn-elevate-air']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">



        <div class="kt-section kt-section--first" style="margin-bottom: 0;">

            <div class="row">
                <div class="col-lg-12">
                    <h3>Profil</h3>
                    <div class="profil">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Visi</h5>
                                        <p class="card-text">
                                            <?=$profil->visi?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Misi</h5>
                                        <p class="card-text">
                                            <?=$profil->misi?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tujuan</h5>
                                        <p class="card-text">
                                            <?=$profil->tujuan?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sasaran</h5>
                                        <p class="card-text">
                                            <?=$profil->sasaran?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Motto</h5>
                                        <p class="card-text">
                                            <?=$profil->motto?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sambutan</h5>
                                        <p class="card-text">
                                            <?=$profil->sambutan?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Struktur Organisasi</h5>
                                        <?php if($profil->struktur_organisasi):?>
                                            <?=Html::img(Yii::getAlias("@.uploadStruktur/{$profil->type}/{$unit->id}/{$profil->struktur_organisasi}"),['width'=>'80%'])?>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
