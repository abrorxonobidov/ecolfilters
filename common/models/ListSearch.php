<?php

namespace common\models;

use yii\data\ActiveDataProvider;

class ListSearch extends Lists
{

    public function rules()
    {
        return [
            [['id', 'category_id', 'order', 'enabled'], 'integer'],
            [['title_uz', 'preview_uz', 'date'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Lists::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'order' => $this->order,
            'date' => $this->date,
            'enabled' => $this->enabled
        ]);

        $query
            ->andFilterWhere(['like', 'title_uz', $this->title_uz])
            ->andFilterWhere(['like', 'preview_uz', $this->preview_uz]);

        return $dataProvider;
    }
}
