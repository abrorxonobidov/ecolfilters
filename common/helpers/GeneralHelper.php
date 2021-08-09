<?php


namespace common\helpers;

use common\models\BaseActiveRecord;
use Yii;
use yii\bootstrap\Html;

class GeneralHelper
{
    public static function oneRow($items)
    {
        foreach ($items as &$item)
            $item = Html::tag('div', $item, ['class' => 'col-md-' . round(12 / count($items))]);
        return Html::tag('div', implode('', $items), ['class' => 'row']);
    }

    public static function titleAndCreateBtn($title = '')
    {
        return GeneralHelper::oneRow([
            Html::tag('h2', $title),
            Html::a(Html::icon('plus') . ' ' . Yii::t('yii', 'Create'), ['create', 'ci' => Yii::$app->request->get('ci')], ['class' => 'btn btn-success pull-right'])
        ]);
    }

    /**
     * @param $model BaseActiveRecord
     * @return string
     */
    public static function actionButtons($model)
    {
        return GeneralHelper::oneRow([
            Html::tag('h2', $model->titleLang),
            Html::a(Html::icon('trash') . ' ' . Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id, 'ci' => Yii::$app->request->get('ci')], [
                'class' => 'view-button btn btn-danger pull-right',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]) .
            Html::a(Html::icon('pencil') . ' ' . Yii::t('yii', 'Update'), ['update', 'id' => $model->id, 'ci' => Yii::$app->request->get('ci')], ['class' => 'view-button btn btn-primary pull-right']) .
            Html::a(Html::icon('plus') . ' ' . Yii::t('yii', 'Create'), ['create', 'ci' => Yii::$app->request->get('ci')], ['class' => 'view-button btn btn-success pull-right']) .
            Html::a(Html::icon('list') . ' ' . Yii::t('main', 'Рўйхат'), ['index', 'ci' => Yii::$app->request->get('ci')], ['class' => 'view-button btn btn-info pull-right'])
        ]);
    }
}