<?php

namespace akreditasi\modules\api;

use Yii;

/**
 * api module definition class
 */
class Api extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'akreditasi\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        Yii::$app->user->enableSession = false;

        Yii::$app->setComponents(require __DIR__ . '/config/api.php');
    }
}
