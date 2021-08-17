<?php
/**
 * @var $items
 */

/*
use yii\helpers\Html;

echo Html::beginTag('div', ['id' => 'MagicZoom', 'class' => 'app-figure']);

echo Html::tag( 'a',
    Html::img($items[0], ['srcset' => $items[0]]),
    [
        'id' => 'Zoom-1',
        'class' => 'MagicZoom',
        'href' => $items[0],
        'title' => 'dddd',
        'data-zoom-image-2x' => $items[0],
        'data-image-2x' => $items[0],
    ]
);

//unset($items[0]);

echo Html::beginTag('div', ['class' => 'selectors']);

foreach ($items as $item)
    echo Html::tag( 'a',
        Html::img($item, ['srcset' => $item]),
        [
            'data-zoom-id' => 'Zoom-1',
            'class' => 'MagicZoom',
            'title' => '_',
            'data-image' => $item,
            'href' => $item,
            'data-zoom-image-2x' => $item,
            'data-image-2x' => $item,
        ]
    );

echo Html::endTag('div');

echo Html::endTag('div');*/

?>

<div class="app-figure" id="MagicZoom">
    <a id="Zoom-1" class="MagicZoom" title="Show your product." href="<?= $items[0] ?>" data-zoom-image-2x="<?= $items[0] ?>" data-image-2x="<?= $items[0] ?>">
        <img src="<?= $items[0] ?>" srcset="<?= $items[0] ?>" alt=""/>
    </a>
    <div class="selectors">
        <? foreach ($items as $item) { ?>
            <a data-zoom-id="Zoom-1" href="<?= $item ?>" data-image="<?= $item ?>" data-zoom-image-2x="<?= $item ?>" data-image-2x="<?= $item ?>">
                <img srcset="<?= $item ?>" src="<?= $item ?>" alt=""/>
            </a>
        <? } ?>
    </div>
</div>