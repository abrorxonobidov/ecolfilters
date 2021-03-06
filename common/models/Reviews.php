<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int|null $author_id
 * @property int $modifier_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $type_id Тип отзыва
 * @property int|null $product_id
 * @property string $name Ваша имя
 * @property string $description Ваш отзыв
 * @property string|null $phone Ваш номер телефона
 * @property string $status
 *
 * @property User $author
 * @property User $modifier
 * @property Product $product
 */
class Reviews extends BaseActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    const TYPE_PRODUCT = 1;
    const TYPE_FEEDBACK = 20;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'modifier_id', 'type_id', 'product_id'], 'integer'],
            [[ 'name', 'description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description', 'status'], 'string'],
            [['status'], 'in', 'range' => [self::STATUS_NEW, self::STATUS_ACCEPTED, self::STATUS_REJECTED]],
            [['type_id'], 'in', 'range' => [self::TYPE_PRODUCT, self::TYPE_FEEDBACK]],
            [['name', 'phone'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['modifier_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['modifier_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'author_id' => Yii::t('main', 'Муаллиф') . ' ID',
            'modifier_id' => Yii::t('main', 'Таҳрирловчи') . ' ID',
            'created_at' => Yii::t('main', 'Яратилган сана'),
            'updated_at' => Yii::t('main', 'Таҳрирланган сана'),
            'type_id' => Yii::t('main', 'Изоҳ тури'),
            'product_id' => Yii::t('main', 'Маҳсулот') . ' ID',
            'name' => Yii::t('main', 'Ф.И.Ш'),
            'description' => Yii::t('main', 'Изоҳингиз'),
            'phone' => Yii::t('main', 'Телефон рақамингиз'),
            'status' => Yii::t('main', 'Status'),
            'modifier.username' => Yii::t('main', 'Таҳрирловчи'),
            'typeName' => Yii::t('main', 'Изоҳ тури')
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Modifier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModifier()
    {
        return $this->hasOne(User::class, ['id' => 'modifier_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function getTypeList()
    {
        return [
            self::TYPE_PRODUCT => Yii::t('main', 'Маҳсулотга нисбатан фикр'),
        ];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_NEW => Yii::t('main', 'Янги'),
            self::STATUS_ACCEPTED => Yii::t('main', 'Сайтда чоп этилган'),
            self::STATUS_REJECTED => Yii::t('main', 'Чоп этилиши тақиқланган'),
        ];
    }

    public static function feedbackStatusList()
    {
        return [
            self::STATUS_NEW => Yii::t('main', 'Янги'),
            self::STATUS_ACCEPTED => Yii::t('main', 'Кўрилган'),
        ];
    }

    public static function getStatusListButtons($id, $route)
    {
        $menu = [];
        foreach (self::getStatusList() as $status => $label) {
            $menu[] = ['label' => $label, 'url' => ['/reviews/set-status', 'route' => $route, 'status' => $status, 'id' => $id], 'linkOptions'=>['class' => 'btn btn-default']];
        }
        return $menu;
    }

    public function getStatusName()
    {
        $statusList = self::getStatusList();
        return $statusList[$this->status];
    }

    public function feedbackStatusName()
    {
        $statusList = self::feedbackStatusList();
        return $statusList[$this->status];
    }


    public function getTypeName()
    {
        $typeList = self::getTypeList();
        return $typeList[$this->type_id]??$this->type_id;
    }
}
