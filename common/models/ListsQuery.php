<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Lists]].
 *
 * @see Lists
 */
class ListsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function isPlace()
    {
        return $this->andWhere(['link' => ['kvartiralar', 'shaxsiy_uylar', 'ofis', 'sanoat', 'korxona']]);
    }

    /**
     * {@inheritdoc}
     * @return Lists[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lists|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
