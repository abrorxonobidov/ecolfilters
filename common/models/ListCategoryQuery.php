<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ListCategory]].
 *
 * @see ListCategory
 */
class ListCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ListCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ListCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
