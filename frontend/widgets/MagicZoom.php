<?php

namespace frontend\widgets;

use yii\base\Widget;

/**
 * Class MagicZoom
 * @package frontend\widgets
 *
 * @property $items
 */
class MagicZoom extends Widget
{

    public $items = [];

    public function run()
    {
        return count($this->items) <= 1 ? '' : $this->render('magic_zoom', [
            'items' => $this->items
        ]);
    }
}