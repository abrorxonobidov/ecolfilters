<?php
/**
 * Created by PhpStorm.
 * User: Abrorxon Obidov
 * Date: 07/05/2021
 * Time: 15:33:00
 */

namespace common\models;

use common\behaviors\CommonTimestampBehavior;
use common\helpers\DebugHelper;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * @property int $id
 * @property int $enabled
 * @property int $order
 * @property string $enable
 * @property User $creator
 * @property User $modifier
 * @property string $titleLang
 * @property string $title
 */
class BaseActiveRecord extends ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => CommonTimestampBehavior::class
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'title' => Yii::t('main', 'Title'),
            'titleLang' => Yii::t('main', 'Title'),
            'enabled' => Yii::t('main', 'Aktiv'),
            'created_at' => Yii::t('main', 'Yaratilgan sana'),
            'updated_at' => Yii::t('main', 'Tahrirlangan sana'),
            'creator_id' => Yii::t('main', 'Yaratuvchi') . ' ID',
            'modifier_id' => Yii::t('main', 'Tahrirlovchi') . ' ID',
            'creator.full_name' => Yii::t('main', 'Yaratuvchi'),
            'modifier.full_name' => Yii::t('main', 'Tahrirlovchi'),
        ];
    }


    /**
     * @return yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getModifier()
    {
        return $this->hasOne(User::class, ['id' => 'modifier_id']);
    }

    /**
     * @return string
     */
    public function getEnable()
    {
        return $this->enabled ? Yii::t('main', 'Active') : Yii::t('main', 'Inactive');
    }

    public function getOrder()
    {
        return $this->order ?? 500;
    }

    /**
     * @return array
     */
    public function getListsEnabled()
    {
        return [
            1 => Yii::t('main', 'Active'),
            0 => Yii::t('main', 'Inactive')
        ];
    }

    /**
     * uploadPath
     * @param string $file
     * @return string
     */
    public function uploadImagePath($file)
    {
        return Yii::$app->params['imageUploadPath'] . $file;
    }

    public function uploadImageMiniPath($file)
    {
        return Yii::$app->params['imageUploadPath'] . 'mini/' . $file;
    }

    public function createGuid()
    {
        $guid = '';
        $uid = uniqid("", true);
        $data = $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $hash = hash('ripemd128', $uid . $guid . md5($data));
        $guid = substr($hash, 0, 8) .
            '-' . substr($hash, 8, 4) .
            '-' . substr($hash, 12, 4) .
            '-' . substr($hash, 16, 4) .
            '-' . substr($hash, 20, 12);
        return $guid;
    }

    /**
     * Upload File.
     * @param string $fileInput
     * @param string $field
     * @param string $table
     * @throws mixed
     */
    public function uploadImage($fileInput, $field, $table = '')
    {
        $image = UploadedFile::getInstance($this, $fileInput);
        if ($image) {
            if (!$this->isNewRecord) {
                if (!empty($this->$field)) {
                    $oldImage = $this->uploadImagePath($this->$field);
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
            }

            $imageName = $this->createGuid() . '_' . $table . '_' . $this->id . '.' . $image->getExtension();
            $this->$field = $imageName;
            $imagePath = $this->uploadImagePath($imageName);

            if (!$image->saveAs($imagePath))
                DebugHelper::printSingleObject($image->error, 1);
        }
    }

    /**
     * Upload File Config.
     * @param string $field
     * @param string $deleteUrl
     * @return array
     */
    public function inputImageConfig($field, $deleteUrl)
    {
        $config = ['path' => [], 'config' => []];
        if (!$this->isNewRecord && !empty($this->$field)) {
            $image = $this->$field;

            $file = $this->uploadImagePath($image);
            if (file_exists($file)) {
                $config['path'] = [Url::to(Yii::$app->params['frontend_domain'] . '/uploads/' . $this->$field)];
                $config['config'] = [
                    [
                        'caption' => $image,
                        'size' => filesize($file),
                        'url' => $deleteUrl,
                        'key' => $this->$field,
                        'extra' => [
                            'id' => $this->id,
                            'field' => $field,
                        ],
                    ]
                ];
            }
        }
        return $config;
    }

    /**
     * Upload File Config.
     * @param string $field
     * @param string $deleteUrl
     * @param string $type
     * @return array
     */
    public function inputFileConfig($field, $deleteUrl, $type = 'object')
    {
        $config = ['path' => [], 'config' => []];
        if (!$this->isNewRecord && !empty($this->$field)) {
            $image = $this->$field;

            $file = $this->uploadImagePath($image);
            if (file_exists($file)) {
                $config['path'] = [Url::to($_SERVER['REQUEST_SCHEME'] . '://' . explode(":", $_SERVER['HTTP_HOST'])[0] . '/uploads/' . $this->$field)];
                $config['config'] = [
                    [
                        'type' => $type,
                        'caption' => $image,
                        'size' => filesize($file),
                        'url' => $deleteUrl,
                        'key' => $file,
                        'extra' => [
                            'id' => $this->id,
                            'field' => $field,
                        ],
                    ]
                ];
            }
        }
        return $config;
    }

    public function removeFile($file)
    {
        $imagePath = $this->uploadImagePath($file);
        $miniImagePath = $this->uploadImageMiniPath($file);

        $arImages = explode(';', $imagePath);
        $key = array_search($imagePath, $arImages);
        unset($arImages[$key]);

        $arImages = explode(';', $miniImagePath);
        $key = array_search($miniImagePath, $arImages);
        unset($arImages[$key]);

        if (file_exists($imagePath))
            unlink($imagePath);

        if (file_exists($miniImagePath))
            unlink($miniImagePath);
    }

    public function getTitleLang()
    {
        return $this->{'title_' . Yii::$app->language};
    }

    public static function getList()
    {
        $list = self::find()
            ->select([
                'id',
                'title' => 'title_' . Yii::$app->language
            ])
            ->where(['enabled' => 1])
            ->asArray()
            ->all();
        $out = [];
        foreach ($list as $item)
            $out[$item['id']] = $item['title'];
        return $out;
    }
}