<?php

namespace backend\models;

use common\models\User;
use Yii;


/**
 * @property string $password
 * @property string $new_password
 * @property string $repeat_password
 */
class UserForm extends User
{

    public $password;

    public $new_password;

    public $repeat_password;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['password', 'repeat_password'], 'required', 'on' => 'create'],
            [['full_name', 'email', 'status'], 'required'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => "Пароллар бир хил эмас", 'on' => 'create'],
            [['username'],
                'match',
                'pattern' => '/^[0-9a-zA-Z]+$/i',
                'message' => 'Фақат лотин алифбоси ва рақамларга рухсат берилган',
            ],
            [
                'repeat_password',
                'compare',
                'compareAttribute' => 'new_password',
                'message' => "Пароллар бир хил эмас",
                'on' => 'update',
                'when' => function (self $model) {
                    return !empty($model->new_password.$model->repeat_password);
                },
            ],
            [
                ['password', 'repeat_password', 'new_password'],
                'required',
                'on' => 'update',
                'when' => function (self $model) {
                    return !empty($model->password.$model->new_password.$model->repeat_password);
                },
                'whenClient' => " function (attribute, value) {
                    return  ($('#userform-password').val() > '' || $('#userform-new_password').val() > '' || $('#userform-repeat_password').val() > '')
                }"
            ],

        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'password' => Yii::t('main', 'Парол'),
            'new_password' => Yii::t('main', 'Янги парол'),
            'repeat_password' => Yii::t('main', 'Паролни тасдиқланг'),
        ]);
    }


}