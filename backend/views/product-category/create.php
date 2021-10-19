<?php

/**
 * @var $this yii\web\View
 * @var $model common\models\ProductCategory
 */

$this->title = Yii::t('yii', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Маҳсулот категориялари'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>

<?= $this->render('_form', [
    'model' => $model
]) ?>
