<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductCategory;

/**
 * ProductCategorySearch represents the model behind the search form of `common\models\ProductCategory`.
 */
class ProductCategorySearch extends ProductCategory
{

    public function rules()
    {
        return [
            [['id', 'order', 'test_drive', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['title_uz', 'title_oz', 'title_ru', 'title_en', 'created_at', 'updated_at'], 'safe'],
        ];
    }


    public function search($params)
    {
        $query = ProductCategory::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order' => $this->order,
            'test_drive' => $this->test_drive,
            'enabled' => $this->enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'creator_id' => $this->creator_id,
            'modifier_id' => $this->modifier_id,
        ]);

        $query->andFilterWhere(['like', 'title_uz', $this->title_uz])
            ->andFilterWhere(['like', 'title_oz', $this->title_oz])
            ->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'title_en', $this->title_en]);

        return $dataProvider;
    }
}
