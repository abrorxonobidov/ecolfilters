<?php

use yii\bootstrap\Html;
use yii\bootstrap\Tabs;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\Lists
 */

$this->title = $model->titleLang;
$this->params['breadcrumbs'][] = $model->isPlace()
    ? ['label' => Yii::t('main', 'Жойлар'), 'url' => ['places']]
    : ['label' => Yii::$app->request->get('ci') ? $model->category->titleLang : Yii::t('main', 'Рўйхат'), 'url' => ['index']];

$this->params['breadcrumbs'][] = yii\helpers\StringHelper::countWords($this->title) > 3 ?
    substr($this->title, 0, 40) . ' ...' : $this->title;

echo common\helpers\GeneralHelper::actionButtons($model);

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'category.titleLang',
        'date',
        'link',
        [
            'attribute' => 'preview_image',
            'value' => Html::img($model::imageSourcePath() . $model->preview_image, ['class' => 'col-md-4'])
                . ' ' . Html::tag('p', $model->preview_image),
            'format' => 'raw'
        ],
        [
            'label' => Yii::t('main', 'Галерея'),
            'format' => 'html',
            'value' => function (common\models\Lists $model) {
                if (!$model->gallery) return '';
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
        [
            'attribute' => 'gallery_inner',
            'format' => 'html',
            'value' => function (common\models\Lists $model) {
                if (!$model->gallery_inner) return '';
                $images = glob($model::uploadImagePath() . $model->gallery_inner . Yii::$app->params['allowedImageExtension'], GLOB_BRACE);
                $gallery = [];
                foreach ($images as $image) {
                    $filePath = explode('/', $image);
                    $fileName = end($filePath);
                    $gallery[] = Html::img($model::imageSourcePath() . $model->gallery_inner . '/' . $fileName, ['style' => 'height:150px;']);
                }
                return implode(' ', $gallery) . Html::tag('br') . $model->gallery_inner;
            },
            'visible' => $model->isPlace()
        ],
        'order',
        [
            'attribute' => 'map',
            'format' => 'raw',
            'visible' => Yii::$app->request->get('ci') == 1
        ],
        //'region_id',
        //'inner_image',
        //'video',
        //'link',
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
            'template' => "<tr><th style='width: 15%;'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                "title_$lang_code",
                "title_inner_1_$lang_code",
                "title_inner_2_$lang_code",
                "preview_$lang_code:raw",
                "description_$lang_code:raw",
                "content_1_$lang_code:raw",
                "content_2_$lang_code:raw",
                "content_3_$lang_code:raw",
            ]
        ])
    ];
}

echo Tabs::widget(['items' => $items]);

echo backend\widgets\AddMetaTags::widget(['model' => $model]);
