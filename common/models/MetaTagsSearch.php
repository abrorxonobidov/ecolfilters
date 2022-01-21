<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MetaTagsSearch represents the model behind the search form of `common\models\MetaTags`.
 */
class MetaTagsSearch extends MetaTags
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'target_id', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['name', 'content', 'target_class', 'url', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MetaTags::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        $query->andFilterWhere([
            'id' => $this->id,
            'target_id' => $this->target_id,
            'enabled' => $this->enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'creator_id' => $this->creator_id,
            'modifier_id' => $this->modifier_id,
            'target_class' => $this->target_class
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere([
                'OR',
                ['like', 'content_uz', $this->content],
                ['like', 'content_oz', $this->content],
                ['like', 'content_ru', $this->content],
                ['like', 'content_en', $this->content],
            ])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
