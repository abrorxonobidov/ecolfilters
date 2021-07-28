<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menus".
 *
 * @property int $id
 * @property string $name
 * @property int $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 *
 * @property MenusLinks[] $menusLinks
 */
class Menus extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'name' => Yii::t('main', 'Name'),
            'enabled' => Yii::t('main', 'Enabled'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'creator_id' => Yii::t('main', 'Creator ID'),
            'modifier_id' => Yii::t('main', 'Modifier ID'),
        ];
    }

    /**
     * Gets query for [[MenusLinks]].
     *
     * @return yii\db\ActiveQuery|MenusLinksQuery
     */
    public function getMenusLinks()
    {
        return $this->hasMany(MenusLinks::class, ['menu_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MenusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenusQuery(get_called_class());
    }
}
