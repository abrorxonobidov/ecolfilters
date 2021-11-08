<?php

/**
 * @var $this yii\web\View
 * @var $model common\models\Currency
 */

$this->title = Yii::t('yii', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Валюта курси'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo yii\helpers\Html::tag('h1', $this->title);

echo $this->render('_form', [
    'model' => $model
]);

