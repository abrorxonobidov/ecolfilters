<?php

namespace frontend\models;

use common\models\Reviews;
use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class Feedback extends Reviews
{
    public $verifyCode;


    public function rules()
    {
        return array_merge(parent::rules(), [
            ['verifyCode', 'captcha'],
        ]);
    }


    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'verifyCode' => Yii::t('main', 'Текшириш коди'),
            'description' => Yii::t('main', 'Сизнинг мурожаатингиз'),
        ]);
    }
}
