<?php

namespace common\models;

use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 * @property $pli
 * @property $pci
 */
class ProductSearch extends Product
{
    /** @var null|integer $pci */
    public $pci= null;
    /** @var null|integer $pli */
    public $pli= null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_category_id', 'place_id', 'order', 'enabled'], 'integer'],
            [['title_uz', 'price'], 'safe'],
            [['pci', 'pli'], 'integer'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        $query->andFilterWhere([
            'id' => $this->id,
            'product_category_id' => $this->product_category_id,
            'place_id' => $this->place_id,
            'enabled' => $this->enabled,
        ]);

        $query
            ->andFilterWhere(['like', 'title_uz', $this->title_uz])
            ->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function searchFrontend($params)
    {
        $query = Product::find()
        ->where([
            'enabled' => 1
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 8]
        ]);

        $this->load($params,'');

        if (!$this->validate()) return $dataProvider;

        $query->andFilterWhere([
            'product_category_id' => $this->pci,
            'place_id' => $this->pli,
        ]);

        return $dataProvider;
    }
}
