<?php


namespace frontend\widgets;


use common\models\Lists;
use yii\base\Widget;

class Services extends Widget
{

    public function run()
    {
        return $this->render('services', [
            'services' => Lists::find()
                ->where(['category_id' => 2, 'enabled' => 1])
                ->limit(5)
                ->all()
        ]);
    }
}