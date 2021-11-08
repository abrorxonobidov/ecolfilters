<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $product_category_id
 * @property int $place_id
 * @property string|null $gallery
 * @property string $preview_image
 * @property string $title_uz
 * @property string|null $title_oz
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string|null $price
 * @property float $price_usd [float(10,2)]
 * @property string|null $preview_uz
 * @property string|null $preview_oz
 * @property string|null $preview_ru
 * @property string|null $preview_en
 * @property string|null $description_uz
 * @property string|null $description_oz
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property string|null $technic_uz
 * @property string|null $technic_oz
 * @property string|null $technic_ru
 * @property string|null $technic_en
 * @property string|null $video_uz
 * @property string|null $video_oz
 * @property string|null $video_ru
 * @property string|null $video_en
 * @property int $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 * @property string $technicLang
 * @property string $videoLang
 *
 * @property Order[] $orders
 * @property Place $place
 * @property ProductCategory $productCategory
 */
class Product extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_category_id', 'place_id', 'title_uz'], 'required'],
            [['product_category_id', 'place_id', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['preview_uz', 'preview_oz', 'preview_ru', 'preview_en', 'description_uz', 'description_oz', 'description_ru', 'description_en', 'technic_uz', 'technic_oz', 'technic_ru', 'technic_en'], 'string'],
            [['created_at', 'updated_at', 'price_usd'], 'safe'],
            [['gallery', 'preview_image', 'title_uz', 'title_oz', 'title_ru', 'title_en', 'price', 'video_uz', 'video_oz', 'video_ru', 'video_en'], 'string', 'max' => 255],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::class, 'targetAttribute' => ['place_id' => 'id']],
            [['product_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['product_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'product_category_id' => Yii::t('main', 'Product Category ID'),
            'place_id' => Yii::t('main', 'Place ID'),
            'preview_image' => Yii::t('main', 'Preview image'),
            'gallery' => Yii::t('main', 'Gallery'),
            'title_uz' => Yii::t('main', 'Title Uz'),
            'title_oz' => Yii::t('main', 'Title Oz'),
            'title_ru' => Yii::t('main', 'Title Ru'),
            'title_en' => Yii::t('main', 'Title En'),
            'price' => Yii::t('main', 'Price'),
            'price_usd' => Yii::t('main', 'Price USD'),
            'preview_uz' => Yii::t('main', 'Preview Uz'),
            'preview_oz' => Yii::t('main', 'Preview Oz'),
            'preview_ru' => Yii::t('main', 'Preview Ru'),
            'preview_en' => Yii::t('main', 'Preview En'),
            'description_uz' => Yii::t('main', 'Description Uz'),
            'description_oz' => Yii::t('main', 'Description Oz'),
            'description_ru' => Yii::t('main', 'Description Ru'),
            'description_en' => Yii::t('main', 'Description En'),
            'technic_uz' => Yii::t('main', 'Technic Uz'),
            'technic_oz' => Yii::t('main', 'Technic Oz'),
            'technic_ru' => Yii::t('main', 'Technic Ru'),
            'technic_en' => Yii::t('main', 'Technic En'),
            'video_uz' => Yii::t('main', 'Video Uz'),
            'video_oz' => Yii::t('main', 'Video Oz'),
            'video_ru' => Yii::t('main', 'Video Ru'),
            'video_en' => Yii::t('main', 'Video En'),
            'enabled' => Yii::t('main', 'Enabled'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'creator_id' => Yii::t('main', 'Creator ID'),
            'modifier_id' => Yii::t('main', 'Modifier ID'),
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return yii\db\ActiveQuery|OrderQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Place]].
     *
     * @return yii\db\ActiveQuery|PlaceQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }

    /**
     * Gets query for [[ProductCategory]].
     *
     * @return yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getProductCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'product_category_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function getTechnicLang()
    {
        return $this->{'technic_' . Yii::$app->language};
    }

    public function getVideoLang()
    {
        return $this->{'video_' . Yii::$app->language};
    }

}
