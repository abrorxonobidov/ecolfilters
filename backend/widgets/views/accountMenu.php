<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 26.12.2015
 * Time: 16:33
 */
/**
 * @var array $items
 */

?>
<?php
echo  \yii\bootstrap\Nav::widget([
    'encodeLabels' => false,
    'options' => ['class' => 'dropdown-menu animation-dock'],
    'items' => $items
])
?>
