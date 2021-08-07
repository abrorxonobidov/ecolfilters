<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('main', 'Қидирув') ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
            <? echo $this->render('_search', ['model' => $searchModel]) ?>
        </div>
        <!-- /.box-body -->
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body" style="">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
            [
                'header' => Yii::t('main', 'Асосий маълумотлар'),
//                'contentOptions' => ['class' => 'col-md-3'],
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \common\models\Reviews $model */
                    return \yii\widgets\DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            ['attribute' => 'id'],
                            ['attribute' => 'created_at'],
                            ['attribute' => 'updated_at'],
                            ['attribute' => 'modifier_id',
                                'value' => $model->modifier->username ?? $model->modifier_id
                            ],
                            ['attribute' => 'type_id',
                                'value' => $model->getTypeName(),
                            ],
                        ]
                    ]);
                }
            ],
            [
                'header' => Yii::t('main', 'Фикр қолдирувчи'),
//                'headerOptions' => ['class' => 'col-md-6'],
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \common\models\Reviews $model */
                    return \yii\widgets\DetailView::widget([
//                        'options' => ['class' => 'table-responsive'],
                        'model' => $model,
                        'attributes' => [
                            ['attribute' => 'name'],
                            ['attribute' => 'phone'],
                            ['attribute' => 'description'],
                        ]
                    ]);
                }
            ],
            [
                'header' => Yii::t('main', 'Фикр ҳолати'),
//                'contentOptions' => ['class' => 'col-md-3'],
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \common\models\Reviews $model */
//                    $buttons = Html::a(Yii::t('main', 'Таҳрирлаш'), ['/reviews/update', 'id' => $model->id, 'route' => Url::to()], ['class' => 'btn btn-default btn-block pjaxModalButton']);
                    $buttons = Html::tag('strong',$model->getStatusName());
                    $buttons .= \yii\bootstrap\ButtonDropdown::widget([
                        'label' => Yii::t('main', 'Холатини ўзгартириш'),
                        'options' => ['class' => 'btn btn-primary btn-block'],
                        'dropdown' => [
                            'items' => $model::getStatusListButtons($model->id, Url::to()),
                        ],
                    ]);
                    return $buttons;
                }
            ],
        ],
    ]); ?>
</div>
