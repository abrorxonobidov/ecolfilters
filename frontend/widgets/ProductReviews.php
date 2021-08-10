<?php


namespace frontend\widgets;


use common\models\Product;
use common\models\Reviews;
use yii\base\Widget;

/**
 * Class ProductReviews
 * @package frontend\widgets
 * @property  Product $product
 */
class ProductReviews extends Widget
{
    public $product;

    public function run()
    {
        $review = new Reviews();
        $review->product_id = $this->product->id;
        return $this->render('product_reviews', [
            'review' => $review
        ]);
    }
}