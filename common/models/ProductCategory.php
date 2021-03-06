<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $title_uz
 * @property string|null $title_oz
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string|null $image
 * @property int $enabled
 * @property int $test_drive
 * @property int $order
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 *
 * @property Product[] $products
 */
class ProductCategory extends BaseActiveRecord
{
    public $imageHelper;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_uz', 'order'], 'required'],
            [['enabled', 'order', 'test_drive', 'creator_id', 'modifier_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title_uz', 'title_oz', 'title_ru', 'title_en', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'title_uz' => Yii::t('main', 'Номланиши') . ' Uz',
            'title_oz' => Yii::t('main', 'Номланиши') . ' Oz',
            'title_ru' => Yii::t('main', 'Номланиши') . ' Ru',
            'title_en' => Yii::t('main', 'Номланиши') . ' En',
            'image' => Yii::t('main', 'Расм'),
            'order' => Yii::t('main', 'Тартиб'),
            'test_drive' => Yii::t('main', 'Test drive'),
            'enabled' => Yii::t('main', 'Статус'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'creator_id' => Yii::t('main', 'Creator ID'),
            'modifier_id' => Yii::t('main', 'Modifier ID'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['product_category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductCategoryQuery(get_called_class());
    }
}
