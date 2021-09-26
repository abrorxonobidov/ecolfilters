<?php
/**
 * @var $this yii\web\View
 * @var $searchModel common\models\ProductSearch;
 * @var $s common\models\ProductSearch;
 */

use common\models\Place;
use common\models\ProductCategory;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-offset-3 col-md-3 text-center">
        <div class="form_box form-group">
            <?= Html::activeDropDownList($searchModel,
                'pci',
                ProductCategory::getList(),
                [
                    'prompt' => ProductCategory::selectText(),
                    'class' => 'productFilter',
                    'name' => 'pci'
                ]) ?>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div class="form_box form-group">
            <?= Html::activeDropDownList($searchModel,
                'pli',
                Place::getList(),
                [
                    'prompt' => Place::selectText(),
                    'class' => 'productFilter',
                    'name' => 'pli'
                ]) ?>
        </div>
    </div>
</div>
<?php $this->registerJs("
$('select').chosen();

let url = '" . Url::to(['/product/compare', 'c_id' => $s->id]) . "';
let queryParam;
$( '.productFilter').change(function() {
    queryParam = '&pci='+$('select[name=\"pci\"]').val()+'&pli='+$('select[name=\"pli\"]').val();
    window.location.replace(url+queryParam);
});
", 3) ?>
