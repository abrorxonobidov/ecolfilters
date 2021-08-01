<?php
namespace frontend\widgets;

use common\models\ProductCategory;
use Yii;
use yii\base\Widget;

class ProductCategoryWidget extends Widget {

    public function run()
    {

        $lang = Yii::$app->language;
        $cats = ProductCategory::find()
            ->select([
                'id',
                'title' => "title_$lang",
                'test_drive'
            ])
            ->where(['enabled' => 1])
            ->orderBy(['order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
        return $this->render('product_category', [
            'cats' => $cats
        ]);
    }
}