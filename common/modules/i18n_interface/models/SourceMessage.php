<?php

namespace common\modules\i18n_interface\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property Message[] $messages
 * @property string $translations
 * @property string $concat_massage
 * @property string $languages
 * @property array $translates_ar
 */
class SourceMessage extends ActiveRecord
{

    public $concat_massage;
    public $languages;

    public $translates_ar;

    public static function languages()
    {
        return [
            'uz' => 'uz',
            'ru' => 'ru',
            'oz' => 'oz',
            'en' => 'en'
        ];
    }

    public static function tableName()
    {
        return 'source_message';
    }

    public function rules()
    {
        return [
            [['message', 'concat_massage'], 'string'],
            [['translates_ar', 'languages'], 'safe'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => Yii::t('main', 'Категория'),
            'message' => Yii::t('main', 'Сўз'),
            'concat_massage' => Yii::t('main', 'Таржималар'),
            'languages' => Yii::t('main', 'Тиллар'),
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::class, ['id' => 'id']);
    }


    public function getCategories()
    {
        return
            ArrayHelper::map(
                self::find()
                    ->select('category')
                    ->groupBy('category')
                    ->asArray()
                    ->all(),
                'category',
                'category'
            );
    }

}
