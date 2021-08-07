<?php


namespace frontend\widgets;


use common\helpers\DebugHelper;
use Yii;
use yii\base\Widget;

class Ordering extends Widget
{

    public function run()
    {
        $url = ['order/create'];
        if(Yii::$app->controller->route === 'product/view')
            $url['pid'] = Yii::$app->request->get('id');
        return $this->render('ordering',['url'=>$url]);
    }
}