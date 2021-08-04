<?php

use yii\helpers\Html;

$languages = Yii::$app->params['languages'];


echo Html::beginTag('div', ['class' => 'dropdown lang_btn']);
echo Html::button($languages[Yii::$app->language] . Html::tag('span', '', ['class' => 'caret']), [
    'class' => 'dropdown-toggle',
    'data-toggle' => 'dropdown'
]);
unset($languages[Yii::$app->language]);
echo Html::beginTag('ul', ['class' => 'dropdown-menu']);

foreach ($languages as $code => $language) {
    $params = Yii::$app->request->queryParams;
    $params[0] = '';
    $params['language'] = $code;
    echo Html::tag('li', Html::a($language, $params));
}
echo Html::endTag('ul');
echo Html::endTag('div');
?>
<!--
<div class="dropdown lang_btn">
    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        O`zbekcha
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dLabel">
        <li><a href="#">Ўзбекча</a></li>
        <li><a href="#">Русский</a></li>
    </ul>
</div>
-->