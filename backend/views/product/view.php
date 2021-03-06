<?php

use yii\bootstrap\Html;
use yii\bootstrap\Tabs;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\Product
 */

$this->title = $model->titleLang;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Маҳсулотлар'), 'url' => ['index']];
$this->params['breadcrumbs'][] = yii\helpers\StringHelper::countWords($this->title) > 3 ?
    substr($this->title, 0, 40) . ' ...' : $this->title;

echo common\helpers\GeneralHelper::actionButtons($model);

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'productCategory.titleLang',
        'place.titleLang',
        [
            'attribute' => 'preview_image',
            'value' => Html::img($model::imageSourcePath() . $model->preview_image, ['class' => 'col-md-4'])
                . ' ' . Html::tag('p', $model->preview_image),
            'format' => 'raw'
        ],
        [
            'label' => Yii::t('main', 'Галерея'),
            'format' => 'html',
            'value' => function (common\models\Product $model) {
                if (!$model->gallery) {
                    return '';
                }
                $images = glob($model::uploadImagePath() . $model->gallery . Yii::$app->params['allowedImageExtension'], GLOB_BRACE);
                $gallery = [];
                foreach ($images as $image) {
                    $filePath = explode('/', $image);
                    $fileName = end($filePath);
                    $gallery[] = Html::img($model::imageSourcePath() . $model->gallery . '/' . $fileName, ['style' => 'height:150px;']);
                }
                return implode(' ', $gallery) . Html::tag('br') . $model->gallery;
            }
        ],
        'price',
        'price_usd',
        'enable',
        'created_at',
        'updated_at',
        'creator.full_name',
        'modifier.full_name',
    ],
]);
$items = [];
foreach (Yii::$app->params['languages'] as $lang_code => $language) {
    $items[] = [
        'label' => $language,
        'content' => DetailView::widget([
            'model' => $model,
            'attributes' => [
                "title_$lang_code",
                "preview_$lang_code:raw",
                "description_$lang_code:raw",
                "technic_$lang_code:raw",
                "video_$lang_code",
            ]
        ])
    ];
}

echo Tabs::widget(['items' => $items]);

echo backend\widgets\AddMetaTags::widget(['model' => $model]);
