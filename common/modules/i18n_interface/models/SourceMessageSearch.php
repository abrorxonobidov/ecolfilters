<?php

namespace common\modules\i18n_interface\models;

use yii\data\ActiveDataProvider;

class SourceMessageSearch extends SourceMessage
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'message', 'concat_massage', 'languages'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SourceMessage::find()
            ->alias('source')
            ->select([
                'source.id',
                'source.category',
                'source.message',
                'concat_massage' => "CONCAT_WS('',uz.translation, ', ',oz.translation, ', ',ru.translation, ', ',en.translation)",
                'languages' => "CONCAT_WS('', uz.language, ' ', oz.language, ' ', ru.language, ' ', en.language)"
            ])
            ->leftJoin(['uz' => Message::tableName()], "uz.id = source.id AND uz.language = 'uz'")
            ->leftJoin(['oz' => Message::tableName()], "oz.id = source.id AND oz.language = 'oz'")
            ->leftJoin(['ru' => Message::tableName()], "ru.id = source.id AND ru.language = 'ru'")
            ->leftJoin(['en' => Message::tableName()], "en.id = source.id AND en.language = 'en'");

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

        if (!$this->validate()) return $dataProvider;

        $query
            ->andFilterWhere([
                'source.id' => $this->id
            ]);

        $query
            ->andFilterWhere(['like', 'source.category', $this->category])
            ->andFilterWhere(['like', 'source.message', $this->message])
            ->andFilterWhere([
                'like',
                "CONCAT_WS('',uz.translation, ', ',oz.translation, ', ',ru.translation, ', ',en.translation)",
                $this->concat_massage
            ])
            ->andFilterWhere([
                'like',
                "CONCAT_WS('', uz.language, ' ', oz.language, ' ', ru.language, ' ', en.language)",
                $this->languages
            ]);

        return $dataProvider;
    }
}
