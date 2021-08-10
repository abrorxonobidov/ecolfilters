<?php

namespace common\models;

use yii\data\ActiveDataProvider;


/**
 * ReviewsSearch represents the model behind the search form of `common\models\Reviews`.
 */
class ReviewsSearch extends Reviews
{
    public $created_at_from;
    public $created_at_to;
    public $updated_at_from;
    public $updated_at_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'modifier_id', 'type_id', 'product_id'], 'integer'],
            [['created_at', 'updated_at', 'name', 'description', 'phone', 'status'], 'safe'],
            [['created_at_from', 'created_at_to', 'updated_at_from', 'updated_at_to'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reviews::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
                'author_id' => $this->author_id,
                'modifier_id' => $this->modifier_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'type_id' => $this->type_id,
                'product_id' => $this->product_id,
                'status' => $this->status,
            ]);

        $query
            ->andFilterWhere(['<=', 'created_at', $this->created_at_from])
            ->andFilterWhere(['>=', 'created_at', $this->created_at_to])
            ->andFilterWhere(['>=', 'updated_at', $this->updated_at_from])
            ->andFilterWhere(['<=', 'updated_at', $this->updated_at_to]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }

    public static function getByProduct($pid, $offset = 0)
    {
        return Reviews::find()
            ->select([
                'id',
                'name',
                'phone',
                'description',
                'created_at',
            ])
            ->where([
                'type_id' => self::TYPE_PRODUCT,
                'status' => 'accepted',
                'product_id' => $pid
            ])
            ->limit(3)
            ->orderBy(['id' => SORT_ASC])
            ->offset($offset)
            //->asArray()
            ->all();
    }
}
