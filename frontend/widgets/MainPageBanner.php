<?php


namespace frontend\widgets;


use common\models\Lists;
use yii\base\Widget;

class MainPageBanner extends Widget
{
    public function run()
    {

        $page = Lists::find()
            ->where([
                'category_id' => 1,
                'link' => 'main_page_banner'
            ])
            ->one();

        return $this->render('main_page_banner', [
            'page' => $page
        ]);
    }

}
