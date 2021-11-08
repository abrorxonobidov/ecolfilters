<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 26.12.2015
 * Time: 16:30
 */

namespace backend\widgets;

use common\models\MetaTags;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/**
 * @property $model
 */
class AddMetaTags extends Widget
{

    public $model;

    public function run()
    {
        return
            Html::tag('h3', 'Meta Tags').
            Html::a(Html::icon('plus') . Html::tag('i', '', ['class' => 'fa fa-code']),
                ['meta-tags/create', 'tcl' => $this->model::className(), 'tid' => $this->model->id],
                ['class' => 'view-button btn btn-info pull-right']
            ) . GridView::widget([
                'summary' => false,
                'dataProvider' => new ActiveDataProvider([
                    'query' => MetaTags::find()
                        ->where([
                            'target_class' => $this->model::className(),
                            'target_id' => $this->model->id
                        ])
                ]),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'content',
                    'enable',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'meta-tags'
                    ]
                ]
            ]);
    }
}
