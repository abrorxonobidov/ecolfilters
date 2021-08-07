<?php

namespace common\modules\i18n_interface;

/**
 * multilingual module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'common\modules\i18n_interface\controllers';
    public $defaultRoute = 'source-message/index';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
