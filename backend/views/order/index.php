<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
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
                        'headerOptions' => ['class' => 'col-md-3'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            /** @var \common\models\Order $model */
                            return \yii\widgets\DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    ['attribute' => 'id'],
                                    ['attribute' => 'created_at'],
                                    ['attribute' => 'updated_at'],
                                    ['attribute' => 'modifier_id',
                                        'value' => $model->modifier->username ?? $model->modifier_id
                                    ],
                                ]
                            ]);
                        }
                    ],
                    [
                        'header' => Yii::t('main', 'Маҳсулот'),
                        'headerOptions' => ['class' => 'col-sm-3'],
                        'format' => 'raw',
                        'value' => function ($data) {
                            /** @var \common\models\Order $data */
                            $model = $data->product;
                            $img = '';
                            if ($model->preview_image)
                                $img = Html::img($model::imageSourcePath() . $model->preview_image, ['class' => 'img-responsive img-thumbnail']);
                            return Html::tag('div', $img . Html::tag('div', Html::tag('div', $model->titleLang, ['class' => 'pull-left']) . Html::a(Yii::t('main', 'Батафсил'), $model::getUrlToFrontend('/product/view', ['id' => $model->id]), ['target' => '_blank', 'class' => 'btn btn-info pull-right'])));
                        }
                    ],
                    [
                        'header' => Yii::t('main', 'Буюртмачи'),
                        'contentOptions' => ['class' => 'col-md-3'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            /** @var \common\models\Order $model */
                            return \yii\widgets\DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    ['attribute' => 'name'],
                                    ['attribute' => 'email'],
                                    ['attribute' => 'phone'],
                                ]
                            ]);
                        }
                    ],
                    [
                        'header' => Yii::t('main', 'Буюртма ҳолати'),
                        'contentOptions' => ['width' => '1%'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            /** @var \common\models\Order $model */
                            $buttons = Html::a(Yii::t('main', 'Таҳрирлаш'), ['/order/update', 'id' => $model->id, 'route' => Url::to()], ['class' => 'btn btn-default btn-block pjaxModalButton']);
                            $buttons .= Html::a($model->getStatusName(), '#', ['class' => 'btn btn-success btn-block']);
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
    </div>
</div>

