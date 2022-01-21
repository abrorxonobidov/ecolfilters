<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "meta_tags".
 *
 * @property int $id
 * @property string $name
 * @property string $content_uz
 * @property string $content_oz
 * @property string $content_ru
 * @property string $content_en
 * @property ActiveQuery|null $target_class
 * @property int|null $target_id
 * @property string|null $url
 * @property int|null $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 *
 * @property string|null $content
 * @property string|null $contentLang
 */
class MetaTags extends BaseActiveRecord
{

    public $content;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta_tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'target_class', 'target_id'], 'required'],
            [['target_id', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['url'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'target_class'], 'string', 'max' => 50],
            [['content_uz', 'content_oz', 'content_ru', 'content_en',], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => Yii::t('main', 'Name'),
            'content' => Yii::t('main', 'Content'),
            'content_uz' => Yii::t('main', 'Content') . ' UZ',
            'content_oz' => Yii::t('main', 'Content') . ' OZ',
            'content_ru' => Yii::t('main', 'Content') . ' RU',
            'content_en' => Yii::t('main', 'Content') . ' EN',
            'target_class' => Yii::t('main', 'Тури'),
            'target_id' => Yii::t('main', 'Тури ID'),
            'url' => Yii::t('main', 'Url'),
        ]);
    }

    /**
     * {@inheritdoc}
     * @return MetaTagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MetaTagsQuery(get_called_class());
    }

    public static function typeList()
    {
        return [
            Product::class => Yii::t('main', 'Махсуотлар'),
            ProductCategory::class => Yii::t('main', 'Махсуотлар категорияси'),
            Lists::class => Yii::t('main', 'Сахифалар'),
            //ListCategory::class => Yii::t('main', 'Руйхат категорияси'),
            //Place::class => Yii::t('main', 'Жойлар'),
        ];
    }

    public function getTargetIdTitle()
    {
        if (empty($this->target_class)) return null;

        $query = (new ActiveQuery($this->target_class::className()))
            ->select(['title' => 'title_' . Yii::$app->language])
            ->where(['id' => $this->target_id])
            ->asArray()
            ->one();

        return $query['title'];
    }

    public function getTargetClassTitle()
    {
        return self::typeList()[$this->target_class];
    }

    public function getContent()
    {
        return $this->{'content_' . Yii::$app->language};
    }

    public function getContentLang()
    {
        return $this->{'content_' . Yii::$app->language};
    }
}
