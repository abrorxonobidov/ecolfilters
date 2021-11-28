<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lists".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title_uz
 * @property string|null $title_oz
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string|null $preview_uz
 * @property string|null $preview_oz
 * @property string|null $preview_ru
 * @property string|null $preview_en
 * @property string|null $description_uz
 * @property string|null $description_oz
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property string|null $preview_image
 * @property string|null $gallery
 * @property int $order
 * @property int|null $region_id
 * @property string|null $inner_image
 * @property string|null $video
 * @property string|null $link
 * @property string|null $map
 * @property string|null $date
 * @property int $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 *
 * @property string $title_inner_1_uz [varchar(255)]
 * @property string $title_inner_1_oz [varchar(255)]
 * @property string $title_inner_1_ru [varchar(255)]
 * @property string $title_inner_1_en [varchar(255)]
 * @property string $title_inner_2_uz [varchar(255)]
 * @property string $title_inner_2_oz [varchar(255)]
 * @property string $title_inner_2_ru [varchar(255)]
 * @property string $title_inner_2_en [varchar(255)]
 * @property string $content_1_uz
 * @property string $content_1_oz
 * @property string $content_1_ru
 * @property string $content_1_en
 * @property string $content_2_uz
 * @property string $content_2_oz
 * @property string $content_2_ru
 * @property string $content_2_en
 * @property string $content_3_uz
 * @property string $content_3_oz
 * @property string $content_3_ru
 * @property string $content_3_en
 * @property string $gallery_inner [varchar(255)]
 *
 * @property ListCategory $category
 * @property ListCategory $titleInner1Lang
 * @property ListCategory $titleInner2Lang
 * @property ListCategory $content1Lang
 * @property ListCategory $content2Lang
 * @property ListCategory $content3Lang
 * @property ListCategory $helpGalleryInner
 *
 *
 */
class Lists extends BaseActiveRecord
{

    public $helpGalleryInner;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title_uz'], 'required'],
            [['category_id', 'order', 'region_id', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['preview_uz', 'preview_oz', 'preview_ru', 'preview_en', 'description_uz', 'description_oz', 'description_ru', 'description_en', 'map'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['title_uz', 'title_oz', 'title_ru', 'title_en', 'preview_image', 'gallery', 'inner_image', 'video', 'link'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ListCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [
                [
                    'title_inner_1_uz', 'title_inner_1_oz', 'title_inner_1_ru', 'title_inner_1_en',
                    'title_inner_2_uz', 'title_inner_2_oz', 'title_inner_2_ru', 'title_inner_2_en',
                    'gallery_inner'
                ],
                'string', 'max' => 255
            ],
            [
                [
                    'content_1_uz', 'content_1_oz', 'content_1_ru', 'content_1_en',
                    'content_2_uz', 'content_2_oz', 'content_2_ru', 'content_2_en',
                    'content_3_uz', 'content_3_oz', 'content_3_ru', 'content_3_en'
                ],
                'string'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'category_id' => Yii::t('main', 'Category ID'),
            'title_uz' => Yii::t('main', 'Title Uz'),
            'title_oz' => Yii::t('main', 'Title Oz'),
            'title_ru' => Yii::t('main', 'Title Ru'),
            'title_en' => Yii::t('main', 'Title En'),
            'preview_uz' => Yii::t('main', 'Preview Uz'),
            'preview_oz' => Yii::t('main', 'Preview Oz'),
            'preview_ru' => Yii::t('main', 'Preview Ru'),
            'preview_en' => Yii::t('main', 'Preview En'),
            'description_uz' => Yii::t('main', 'Description Uz'),
            'description_oz' => Yii::t('main', 'Description Oz'),
            'description_ru' => Yii::t('main', 'Description Ru'),
            'description_en' => Yii::t('main', 'Description En'),
            'preview_image' => Yii::t('main', 'Preview Image'),
            'gallery' => Yii::t('main', 'Gallery'),
            'gallery_inner' => Yii::t('main', 'Inner slider'),
            'helpGalleryInner' => Yii::t('main', 'Inner slider'),
            'order' => Yii::t('main', 'Order'),
            'region_id' => Yii::t('main', 'Region ID'),
            'inner_image' => Yii::t('main', 'Inner Image'),
            'video' => Yii::t('main', 'Video'),
            'link' => Yii::t('main', 'Page code'),
            'map' => Yii::t('main', 'Google Харита'),
            'date' => Yii::t('main', 'Date'),
            'enabled' => Yii::t('main', 'Enabled'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'creator_id' => Yii::t('main', 'Creator ID'),
            'modifier_id' => Yii::t('main', 'Modifier ID'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ListCategory::class, ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     * @return ListsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ListsQuery(get_called_class());
    }

    public function getTitleInner1Lang()
    {
        return $this->{'title_inner_1_' . Yii::$app->language};
    }

    public function getTitleInner2Lang()
    {
        return $this->{'title_inner_2_' . Yii::$app->language};
    }

    public function getContent1Lang()
    {
        return $this->{'content_1_' . Yii::$app->language};
    }

    public function getContent2Lang()
    {
        return $this->{'content_2_' . Yii::$app->language};
    }

    public function getContent3Lang()
    {
        return $this->{'content_3_' . Yii::$app->language};
    }

    public function isPlace()
    {
        return in_array($this->link, ['kvartiralar', 'shaxsiy_uylar', 'ofis', 'sanoat', 'korxona']);
    }
}
