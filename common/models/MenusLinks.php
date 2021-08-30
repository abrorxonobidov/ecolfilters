<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menus_links".
 *
 * @property int $id
 * @property int $menu_id
 * @property int|null $parent_id
 * @property string $title_uz
 * @property string|null $title_oz
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string|null $link_in
 * @property string|null $link_out
 * @property int $order
 * @property string|null $icon
 * @property int $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 *
 * @property Menus $menu
 * @property MenusLinks $parent
 * @property MenusLinks[] $children
 */
class MenusLinks extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menus_links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_id', 'title_uz', 'order'], 'required'],
            [['menu_id', 'parent_id', 'order', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['link_out', 'icon'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title_uz', 'title_oz', 'title_ru', 'title_en', 'link_in'], 'string', 'max' => 255],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::class, 'targetAttribute' => ['menu_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => MenusLinks::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'menu_id' => Yii::t('main', 'Меню тоифаси'),
            'parent_id' => Yii::t('main', 'Parent ID'),
            'title_uz' => Yii::t('main', 'Title Uz'),
            'title_oz' => Yii::t('main', 'Title Oz'),
            'title_ru' => Yii::t('main', 'Title Ru'),
            'title_en' => Yii::t('main', 'Title En'),
            'link_in' => Yii::t('main', 'Link In'),
            'link_out' => Yii::t('main', 'Link Out'),
            'order' => Yii::t('main', 'Order'),
            'icon' => Yii::t('main', 'Icon'),
            'enabled' => Yii::t('main', 'Enabled'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'creator_id' => Yii::t('main', 'Creator ID'),
            'modifier_id' => Yii::t('main', 'Modifier ID'),
        ];
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return yii\db\ActiveQuery|MenusQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::class, ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return yii\db\ActiveQuery|MenusLinksQuery
     */
    public function getParent()
    {
        return $this->hasOne(MenusLinks::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[MenusLinks]].
     *
     * @return yii\db\ActiveQuery|MenusLinksQuery
     */
    public function getChildren()
    {
        return $this->hasMany(MenusLinks::class, ['parent_id' => 'id']);
    }


    /**
     * Gets query for [[MenusLinks]].
     *
     * @return yii\db\ActiveQuery|MenusLinksQuery
     */
    public function getItems()
    {
        return $this->hasMany(MenusLinks::class, ['parent_id' => 'id']);
    }


    public function getParentList()
    {
            $data = self::find()
                ->select([
                    'id',
                    'title' => 'title_' . Yii::$app->language
                ])
                ->filterWhere([
                    'menu_id' => $this->menu_id,
                ])
                ->andWhere('parent_id IS NULL')
                ->asArray()
                ->all();
            $return = [];
            foreach ($data as $item)
                $return[$item['id']] = $item['title'];

        return $return;
    }

    /**
     * {@inheritdoc}
     * @return MenusLinksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenusLinksQuery(get_called_class());
    }
}
