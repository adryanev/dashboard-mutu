<?php


use yii\helpers\Html;

$namaLengkap = Html::encode(Yii::$app->user->identity->profilUser->nama_lengkap);
$inisial = mb_strtoupper(mb_substr(Html::encode(Yii::$app->user->identity->profilUser->nama_lengkap), 0, 1));

$roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
$role = ucfirst(array_keys($roles)[0]);

$user = Yii::$app->user->identity;

$controller = $this->context->id;
$action = $this->context->action->id;

?>
<!--Begin:: App Aside-->
<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

    <!--begin:: Widgets/Applications/User/Profile1-->
    <div class="kt-portlet kt-portlet--height-fluid-">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit-y">

            <!--begin::Widget -->
            <div class="kt-widget kt-widget--user-profile-1">
                <div class="kt-widget__head">
                    <div class="kt-widget__media">
                        <span class="kt-userpic kt-userpic--xl  kt-userpic--success ">
														<span><?= $inisial ?></span>
													</span>
                    </div>
                    <div class="kt-widget__content">
                        <div class="kt-widget__section">
                            <a href="#" class="kt-widget__username">
                                <?= $namaLengkap ?>
                                <i class="flaticon2-correct kt-font-success"></i>
                            </a>
                            <span class="kt-widget__subtitle">
																<?= $role ?>
															</span>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__body">
                    <div class="kt-widget__content">
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Email:</span>
                            <a href="#" class="kt-widget__data"><?= $user->email ?></a>
                        </div>
                    </div>
                    <div class="kt-widget__items">
                        <a href="<?= \yii\helpers\Url::to(['default/index']) ?>"
                           class="kt-widget__item <?= $controller !== 'default' ?: "kt-widget__item--active" ?>">
															<span class="kt-widget__section">
																<span class="kt-widget__icon">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                         height="24px" viewBox="0 0 24 24" version="1.1"
                                                                         class="kt-svg-icon">
																		<g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
																			<polygon id="Bound"
                                                                                     points="0 0 24 0 24 24 0 24"/>
																			<path
                                                                                d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                                                id="Shape" fill="#000000"
                                                                                fill-rule="nonzero"/>
																			<path
                                                                                d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                                                id="Path" fill="#000000" opacity="0.3"/>
																		</g>
																	</svg> </span>
																<span class="kt-widget__desc">
																	Profil
																</span>
															</span>
                            <!--                            <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--rounded kt-badge--bolder">9</span>-->

                        </a>
                        <a href="<?= \yii\helpers\Url::to(['account/edit-account']) ?>"
                           class="kt-widget__item <?= $action !== 'edit-account' ?: "kt-widget__item--active" ?>">
															<span class="kt-widget__section">
																<span class="kt-widget__icon">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                         height="24px" viewBox="0 0 24 24" version="1.1"
                                                                         class="kt-svg-icon">
																		<g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
																			<rect id="bound" x="0" y="0" width="24"
                                                                                  height="24"/>
																			<path
                                                                                d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                                                id="Combined-Shape" fill="#000000"
                                                                                opacity="0.3"/>
																			<path
                                                                                d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                                                id="Combined-Shape" fill="#000000"/>
																		</g>
																	</svg> </span>
																<span class="kt-widget__desc">
																	Edit Akun
																</span>
                                                                </span>
                        </a>
                        <a href="<?= \yii\helpers\Url::to(['account/change-password']) ?>"
                           class="kt-widget__item <?= $action !== 'change-password' ?: "kt-widget__item--active" ?>">
															<span class="kt-widget__section">
																<span class="kt-widget__icon">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                         height="24px" viewBox="0 0 24 24" version="1.1"
                                                                         class="kt-svg-icon">
																		<g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
																			<rect id="bound" x="0" y="0" width="24"
                                                                                  height="24"/>
																			<path
                                                                                d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                                                                id="Path-50" fill="#000000"
                                                                                opacity="0.3"/>
																			<path
                                                                                d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z"
                                                                                id="Mask" fill="#000000" opacity="0.3"/>
																			<path
                                                                                d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                                                                id="Mask-Copy" fill="#000000"
                                                                                opacity="0.3"/>
																		</g>
																	</svg> </span>
																<span class="kt-widget__desc">
																	Ubah Password
																</span>
															</span>
                        </a>

                    </div>
                </div>
            </div>

            <!--end::Widget -->
        </div>
    </div>

    <!--end:: Widgets/Applications/User/Profile1-->
</div>

<!--End:: App Aside--><?php
