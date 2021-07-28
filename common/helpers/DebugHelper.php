<?php
/**
 * Created by JetBrains PhpStorm.
 * User: a_niyazov
 * Date: 14.11.13
 * Time: 15:26
 * To change this template use File | Settings | File Templates.
 */
namespace common\helpers;
use yii\db\ActiveRecord;

/**
 * Class DebugHelper
 * @package common\helpers
 */
class DebugHelper
{
    /**
     * @param $object
     * @param bool $die
     * @param boolean $pre
     * @param boolean $varDump
     */
    public static function printSingleObject($object, $die = false,$pre = true, $varDump = false)
    {
        if($pre)
            echo "<pre>";
        if(!$varDump)
            print_r($object);
        else
            var_dump($object);
        if($pre)
            echo "</pre>";
        if($die) die;
    }

    /**
     * @param $objectsArray
     * @param bool $die
     */
    public static function printObjectsArray($objectsArray, $die = false)
    {
        echo "<pre>";
        foreach($objectsArray as $object)
        {
            print_r($object);
        }
        echo "</pre>";
        if($die) die;
    }

    /**
     * @param ActiveRecord $object
     * @param bool $die
     */
    public static function printActiveRecordsModel($object, $die = false)
    {
        echo "<pre>"; print_r($object->getAttributes()); echo "</pre>";
        if($die) die;
    }

    /**
     * @param ActiveRecord[] $objectsArray
     * @param bool $die
     */
    public static function printActiveRecordsArray($objectsArray, $die = false)
    {
        echo "<pre>";
        foreach($objectsArray as $object)
        {
            print_r($object->getAttributes());
        }
        echo "</pre>";
        if($die) die;
    }

    /**
     * @param $text
     * @param bool $die
     */
    public static function printToSandBox($text, $die = false)
    {
        if(strpos($_SERVER["HTTP_HOST"], "dev"))
        {
            echo $text;
        }
        else
        {
            echo "";
        }
        if($die) die;
    }

}