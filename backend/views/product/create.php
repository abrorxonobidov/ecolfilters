<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model common\models\Product
 */

$this->title = Yii::t('yii', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Маҳсулотлар'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


echo Html::tag('h1', $this->title);

echo $this->render('_form', [
    'model' => $model,
]);
