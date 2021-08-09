<?php

namespace common\modules\i18n_interface\models;

use Yii;
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
 */
class SourceMessage extends \yii\db\ActiveRecord
{

    public $messagess;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'messagess'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id' => 'id']);
    }

    public function getTranslationsLangs()
    {
        // postgresql
        //  if ($langs = Message::find()->select('array_agg(language) as language')->where(['id' => $this->id])->one())
        //mysql
        if ($langs = Message::find()->select('group_concat(language) as language')->where(['id' => $this->id])->one())
            return $langs->language;
    }

    public function getTranslations()
    {
        // postgresql
        // if ($langs = Message::find()->select('array_agg(translation) as translation')->where(['id' => $this->id])->one())
         if ($langs = Message::find()->select('group_concat(translation) as translation')->where(['id' => $this->id])->one())
            return $langs->translation;
    }

    public function getCategories()
    {
        $categories = ArrayHelper::map(self::find()->select('category')->groupBy('category')->asArray()->all(), 'category', 'category');
        return $categories;
    }

}
