<?php
/**
 * Created by PhpStorm.
 * User: a_obidov
 * Date: 09.01.2021
 * Time: 18:37
 */

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Class BaseController
 * @package backend\controllers
 */
class BaseController extends Controller {


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
};