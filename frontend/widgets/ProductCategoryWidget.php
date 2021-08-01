<?php
namespace frontend\widgets;

use yii\base\Widget;

class ProductCategoryWidget extends Widget {

    public function run()
    {
        return $this->render('product_category', [
            'menus' => []
        ]);
    }
}