<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "list_category".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title_uz
 * @property string $title_oz
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string|null $image
 * @property int|null $type_id
 * @property int $order
 * @property int $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 *
 * @property ListCategory $parent
 * @property ListCategory[] $listCategories
 * @property Lists[] $lists
 */
class ListCategory extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'list_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'type_id', 'order', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['title_uz', 'title_oz'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title_uz', 'title_oz', 'title_ru', 'title_en', 'image'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ListCategory::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'parent_id' => Yii::t('main', 'Parent ID'),
            'title_uz' => Yii::t('main', 'Title Uz'),
            'title_oz' => Yii::t('main', 'Title Oz'),
            'title_ru' => Yii::t('main', 'Title Ru'),
            'title_en' => Yii::t('main', 'Title En'),
            'image' => Yii::t('main', 'Image'),
            'type_id' => Yii::t('main', 'Type ID'),
            'order' => Yii::t('main', 'Order'),
            'enabled' => Yii::t('main', 'Enabled'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'creator_id' => Yii::t('main', 'Creator ID'),
            'modifier_id' => Yii::t('main', 'Modifier ID'),
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return yii\db\ActiveQuery|ListCategoryQuery
     */
    public function getParent()
    {
        return $this->hasOne(ListCategory::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[ListCategories]].
     *
     * @return yii\db\ActiveQuery|ListCategoryQuery
     */
    public function getListCategories()
    {
        return $this->hasMany(ListCategory::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Lists]].
     *
     * @return yii\db\ActiveQuery|ListsQuery
     */
    public function getLists()
    {
        return $this->hasMany(Lists::class, ['category_id' => 'id']);
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
