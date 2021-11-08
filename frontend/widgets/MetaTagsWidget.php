<?php

namespace frontend\widgets;

use common\models\MetaTags;
use yii\base\Widget;

/**
 * Class MetaTagsWidget
 * @property string $target_class
 * @property int $target_id
 */
class MetaTagsWidget extends Widget
{

    public $target_class;

    public $target_id;

    public function run()
    {
        $meta_tags = MetaTags::find()
            ->where([
                'target_class' => $this->target_class,
                'target_id' => $this->target_id,
                'enabled' => 1
            ])
            ->all();

        foreach ($meta_tags as $meta_tag)
            $this->view->registerMetaTag([
                'name' => $meta_tag->name,
                'content' => $meta_tag->content
            ]);
    }
}
