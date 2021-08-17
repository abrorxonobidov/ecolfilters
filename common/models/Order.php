<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property int $enabled
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property int|null $modifier_id
 * @property string $status
 * @property string $comment
 *
 * @property Product $product
 */
class Order extends BaseActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_PROCESS = 'process';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['email', 'required', 'when' => function ($attribute) {
                return empty($this->phone);
            },'message' => Yii::t('main', 'Телефон ёки e-mail ни киритинг')],
            ['phone', 'required', 'when' => function ($attribute) {
                return empty($this->email);
            },'message' => Yii::t('main', 'Телефон ёки e-mail ни киритинг')],
            [['product_id', 'enabled', 'creator_id', 'modifier_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'phone'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['status'], 'in', 'range' => [self::STATUS_NEW, self::STATUS_PROCESS, self::STATUS_ACCEPTED, self::STATUS_REJECTED]],
            [['comment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'Буюртма идентификацион рақами'),
            'product_id' => Yii::t('main', 'Маҳсулот'),
            'name' => Yii::t('main', 'Ф.И.Ш'),
            'email' => Yii::t('main', 'Email'),
            'phone' => Yii::t('main', 'Телефон'),
            'enabled' => Yii::t('main', 'Актив'),
            'created_at' => Yii::t('main', 'Буюртма берилган сана'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'creator_id' => Yii::t('main', 'Author ID'),
            'modifier_id' => Yii::t('main', 'Modifier ID'),
            'status' => Yii::t('main', 'Буюртма ҳолати'),
            'comment' => Yii::t('main', 'Модератор изоҳи'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return yii\db\ActiveQuery|ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_NEW => Yii::t('main', 'Янги'),
            self::STATUS_PROCESS => Yii::t('main', 'Жараёнда'),
            self::STATUS_ACCEPTED => Yii::t('main', 'Бажарилган'),
            self::STATUS_REJECTED => Yii::t('main', 'Рад этилган'),
        ];
    }

    public static function getStatusListButtons($id, $route)
    {
        $menu = [];
        foreach (self::getStatusList() as $status => $label) {
            $menu[] = ['label' => $label, 'url' => ['/order/set-status', 'route' => $route, 'status' => $status, 'id' => $id], 'linkOptions' => ['class' => 'btn btn-default']];
        }
        return $menu;
    }

    public function getStatusName()
    {
        $statusList = self::getStatusList();
        return $statusList[$this->status] ?? $this->status;
    }
}
