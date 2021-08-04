<?php


namespace frontend\widgets;


use common\models\Product;
use yii\base\Widget;

/**
 * Class ProductReviews
 * @package frontend\widgets
 * @property  Product$product
 */
class ProductReviews extends Widget
{
    public $product;

    public function run()
    {
        return $this->render('product_reviews');
    }
}