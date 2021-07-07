<?php

namespace akreditasi\modules\kriteria9\controllers;

/**
 * Default controller for the `kriteria9` module
 */
class DefaultController extends BaseController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
