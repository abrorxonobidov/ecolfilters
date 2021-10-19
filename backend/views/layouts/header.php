<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $content string
 * @var common\models\User $user
 */
$user = Yii::$app->user->identity;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ECO</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <ul class="nav navbar-nav">
            <li class="breadcrumbs-item">
                <?= yii\widgets\Breadcrumbs::widget([
                    'links' => $this->params['breadcrumbs'] ?? []
                ]) ?>
            </li>
        </ul>

        <div class="navbar-custom-menu">
            <?= backend\widgets\HeaderNotifications::widget([
                'user' => $user,
                'arTypes' => [
//                    'orders',
                    'new-orders',
                    'new-reviews',
                    'feedback',
                ]
            ]) ?>
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">
                            <?= Yii::$app->user->identity->username ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    Html::tag('i', '', ['class' => 'fa fa-sign-out'])
                                    . ' Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
