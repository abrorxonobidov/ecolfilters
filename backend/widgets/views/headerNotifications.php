<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 12.08.2016
 * Time: 13:16
 * @var array $items
 */

use yii\helpers\Url;

?>
<ul class="nav navbar-nav notifications-menu">
    <? foreach ($items as $item) { ?>
        <? if (!isset($item['items']) || count($item['items']) == 0) { ?>
            <li class="dropdown notifications-menu ">
                <a href="<?= Url::to($item['url']) ?>" title="<?= $item['title'] ?>"
                   class="">
                    <i class="<?= $item['icon'] ?> "></i>
                    <span class="label label-<?= isset($item['countStyle']) ? $item['countStyle'] : 'danger' ?>"><?= $item['count'] ?></span>
                </a>
            </li>
        <? } else { ?>
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" title="<?= $item['title'] ?>" data-toggle="dropdown">
                    <i class="<?= $item['icon'] ?>  btn-bell"></i>
                    <span class="label label-<?= isset($item['countStyle']) ? $item['countStyle'] : 'danger' ?>"><?= $item['count'] ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"><?= $item['title'] ?></li>
                    <li>
                        <ul class="menu">
                            <? foreach ($item['items'] as $subItem) { ?>
                                <li>
                                    <a href="<?= Url::to($subItem['url']) ?>">
                                        <i class="<?= $subItem['icon'] ?>"></i>
                                        <span class="<?=$subItem['labelClass']?>"><?= $subItem['title'] ?> </span></a>
                                </li>

                            <? } ?>
                        </ul>
                    </li>
                    <li class="divider"></li>
                </ul>
            </li>
        <? }
    } ?>
</ul>
