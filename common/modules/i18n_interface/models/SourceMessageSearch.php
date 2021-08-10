<?php

namespace common\modules\i18n_interface\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\i18n_interface\models\SourceMessage;

/**
 * SourceMessageSearch represents the model behind the search form about `common\modules\i18n_interface\models\SourceMessage`.
 */
class SourceMessageSearch extends SourceMessage
{


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'message', 'messagess'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = SourceMessage::find()->alias('source');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('messages');

        // grid filtering conditions
        $query->andFilterWhere([
            'source.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'source.category', $this->category])
            ->andFilterWhere(['like', 'source.message', $this->message])
            ->andFilterWhere(['like', 'message.translation', $this->messagess]);

        return $dataProvider;
    }
}
