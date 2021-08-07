<?php
/**
 * This is the template for generating a controller class file.
 */

/* @var $this yii\web\View */
/* @var $messages array */

echo "<?php\n";
?>
/* Automatic generated file */
return [
<?php foreach ($messages as $message): ?>
    <?php echo "\t'" . preg_replace("/\'/","\'", $message['key']) . "' => '" .preg_replace("/\'/","\'", $message['value']) . "',\n"; ?>
<?php endforeach; ?>
];
?>
