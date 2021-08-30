<?php


namespace frontend\widgets;


use common\models\ListCategory;
use common\models\Lists;
use Yii;
use yii\base\Widget;

class Partners extends Widget
{

    public function run()
    {
        $partners = Lists::find()
            ->select([
                'title_' . Yii::$app->language,
                'preview_image'
            ])
            ->where([
                'enabled' => 1,
                'category_id' => 6
            ])
            ->orderBy('order')
            ->all();
        return $this->render('partners', [
            'partners' => $partners,
            'title' => @ListCategory::findOne(6)->titleLang
        ]);
    }
}