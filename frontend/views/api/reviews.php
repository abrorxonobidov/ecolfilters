<?php

/**
 * @var $reviews common\models\Reviews[]
 */

foreach ($reviews as $review) { ?>
    <div class="rev_users_b">
        <ul class="rev_list">
            <li>
                <span><img src="/img/users_img.png" alt=""/></span>
                <i><?= $review->name ?></i>
            </li>
            <li> <?= date('d.m.Y', strtotime($review->created_at)) ?></li>
            <li><?= date('H:i', strtotime($review->created_at)) ?></li>
        </ul>
        <p>
            <?= $review->description ?>
        </p>
    </div>
<? } ?>