<?php
/**
 * @var $this \yii\web\View
 * @var $searchModel \common\models\ProductSearch;
 */


use common\models\Place;
use common\models\ProductCategory;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<section class="block_2">
    <span><img src="/img/section_2.2_image.jpg" alt=""/></span>
    <div class="sec_2_text sec_2_text_in">
        <p><?=Yii::t('main','Уй ва офис учун инновацион сувни тозалаш тизимлари')?></p>
        <div class="form_box form-group">
            <?= Html::activeDropDownList($searchModel, 'pci', ProductCategory::getList(), ['prompt' => ProductCategory::selectText(), 'class' => 'productFilter', 'name' => 'pci']) ?>
        </div>
        <div class="form_box form-group">
            <?= Html::activeDropDownList($searchModel, 'pli', Place::getList(), ['prompt' => Place::selectText(), 'class' => 'productFilter', 'name' => 'pli']) ?>
        </div>
    </div>
</section>
<?php $this->registerJs("
$('select').chosen();
let url = '" . Url::to(['/product/category']) . "';
$( '.productFilter').change(function() {
let queryParam = '?pci='+$('select[name=\"pci\"]').val()+'&pli='+$('select[name=\"pli\"]').val();
    window.location.replace(url+queryParam);
});
") ?>
