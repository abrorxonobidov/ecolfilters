<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property float $rate
 * @property int|null $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 */
class Currency extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate'], 'required'],
            [['rate'], 'number'],
            [['enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'rate' => Yii::t('main', 'Курс'),
        ]);
    }

    /**
     * {@inheritdoc}
     * @return CurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencyQuery(get_called_class());
    }

    public static function getLastRate()
    {
        return @self::find()
            ->select('rate')
            ->active()
            ->orderBy('id DESC')
            ->limit(1)
            ->asArray()
            ->column()[0];
    }
}
