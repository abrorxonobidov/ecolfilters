<?php

namespace common\models;

use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{

    public function rules()
    {
        return [
            [['product_id', 'enabled'], 'integer'],
            [['name', 'email', 'phone', 'status', 'comment'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        $query
            ->andFilterWhere([
                'id' => $this->id,
                'product_id' => $this->product_id,
                'enabled' => $this->enabled,
                'status' => $this->status,
            ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
