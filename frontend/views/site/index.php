<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ArrayDataProvider
 */

$this->title = Yii::t('main', 'Тоза сув — <br>бу ECOFILTERS');

echo frontend\widgets\MetaTagsWidget::widget(['target_class' => common\models\Lists::className(), 'target_id' => 41]);

?>

<section class="news_block">
    <div class="container has_width">
        <div class="title">
            <?= Yii::t('main', 'Янгиликлар') ?>
        </div>

        <?= yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items} \n <div class='text-center'> {pager}</div>",
            'itemView' => '_news_item',
            'itemOptions' => [
                'tag' => 'div',
                'class' => 'news_box'
            ],
            'options' => [
                'tag' => 'div',
                'class' => 'news_list'
            ]
        ]) ?>
    </div>
</section>