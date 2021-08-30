<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/**
 * @var $this yii\web\View
 * @var $searchModel common\models\ReviewsSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('main', 'Қайта алоқа');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <div class="box-body" style="">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => ['class' => 'table-responsive'],
                'columns' => [
                    'id',
                    'name',
                    'phone',
                    'description',
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel::feedbackStatusList(),
                        'header' => Yii::t('main', 'Фикр ҳолати'),
                        'contentOptions' => ['class' => 'col-md-2'],
                        'format' => 'raw',
                        'value' => function (common\models\Reviews $model) {
                            $buttons = Html::tag('strong', $model->feedbackStatusName());
                            $buttons .= Html::beginTag('br') . yii\bootstrap\ButtonDropdown::widget([
                                    'label' => Html::icon('pencil'),
                                    'options' => ['class' => 'btn btn-primary btn-block'],
                                    'encodeLabel' => false,
                                    'dropdown' => [
                                        'items' => [
                                            [
                                                'label' => Yii::t('main', 'Кўрилган'),
                                                'url' => ['reviews/set-status', 'route' => Url::to(), 'status' => 'accepted', 'id' => $model->id]
                                            ],
                                            [
                                                'label' => Yii::t('main', 'Янги'),
                                                'url' => ['reviews/set-status', 'route' => Url::to(), 'status' => 'new', 'id' => $model->id]
                                            ]
                                        ],
                                    ],
                                ]);
                            return $buttons;
                        }
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>

