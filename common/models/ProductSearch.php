<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_category_id', 'place_id', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['gallery', 'title_uz', 'title_oz', 'title_ru', 'title_en', 'price', 'preview_uz', 'preview_oz', 'preview_ru', 'preview_en', 'description_uz', 'description_oz', 'description_ru', 'description_en', 'technic_uz', 'technic_oz', 'technic_ru', 'technic_en', 'video_uz', 'video_oz', 'video_ru', 'video_en', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_category_id' => $this->product_category_id,
            'place_id' => $this->place_id,
            'enabled' => $this->enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'creator_id' => $this->creator_id,
            'modifier_id' => $this->modifier_id,
        ]);

        $query->andFilterWhere(['like', 'gallery', $this->gallery])
            ->andFilterWhere(['like', 'title_uz', $this->title_uz])
            ->andFilterWhere(['like', 'title_oz', $this->title_oz])
            ->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'preview_uz', $this->preview_uz])
            ->andFilterWhere(['like', 'preview_oz', $this->preview_oz])
            ->andFilterWhere(['like', 'preview_ru', $this->preview_ru])
            ->andFilterWhere(['like', 'preview_en', $this->preview_en])
            ->andFilterWhere(['like', 'description_uz', $this->description_uz])
            ->andFilterWhere(['like', 'description_oz', $this->description_oz])
            ->andFilterWhere(['like', 'description_ru', $this->description_ru])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'technic_uz', $this->technic_uz])
            ->andFilterWhere(['like', 'technic_oz', $this->technic_oz])
            ->andFilterWhere(['like', 'technic_ru', $this->technic_ru])
            ->andFilterWhere(['like', 'technic_en', $this->technic_en])
            ->andFilterWhere(['like', 'video_uz', $this->video_uz])
            ->andFilterWhere(['like', 'video_oz', $this->video_oz])
            ->andFilterWhere(['like', 'video_ru', $this->video_ru])
            ->andFilterWhere(['like', 'video_en', $this->video_en]);

        return $dataProvider;
    }
}
