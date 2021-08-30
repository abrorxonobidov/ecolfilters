<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class ListSearch extends Lists
{

    public function rules()
    {
        return [
            [['id', 'category_id', 'order', 'enabled'], 'integer'],
            [['title_uz', 'preview_uz', 'link', 'date'], 'safe'],
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
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'title_uz', $this->title_uz])
            ->andFilterWhere(['like', 'preview_uz', $this->preview_uz]);

        return $dataProvider;
    }

    public static function searchNews($limit = null)
    {
        $lang = Yii::$app->language;
        return new ArrayDataProvider([
            'allModels' => Lists::find()
                ->select([
                    'id',
                    'date',
                    "title_$lang",
                    "preview_$lang",
                    'preview_image',
                ])
                ->where([
                    'category_id' => 3,
                    'enabled' => 1,
                ])
                ->orderBy([
                    'date' => SORT_DESC,
                    'order' => SORT_ASC
                ])
                ->limit($limit)
                ->all(),
            'pagination' => [
                'pageSize' => 6
            ]
        ]);
    }
}
