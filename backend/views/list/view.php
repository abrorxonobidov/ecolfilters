<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\Lists
 */

$this->title = $model->titleLang;
$this->params['breadcrumbs'][] = [
    'label' => Yii::$app->request->get('ci') ? $model->category->titleLang : Yii::t('main', 'Рўйхат'),
    'url' => ['index', 'ci' => Yii::$app->request->get('ci')]
];
$this->params['breadcrumbs'][] = $this->title;

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
        'order',
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
            'attributes' => [
                "title_$lang_code",
                "preview_$lang_code:raw",
                "description_$lang_code:raw",
            ]
        ])
    ];
}

echo Tabs::widget(['items' => $items]);