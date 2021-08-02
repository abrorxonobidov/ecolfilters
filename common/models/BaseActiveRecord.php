<?php
/**
 * Created by PhpStorm.
 * User: Abrorxon Obidov
 * Date: 27/07/2021
 * Time: 15:33:00
 */

namespace common\models;

use common\behaviors\CommonTimestampBehavior;
use common\helpers\DebugHelper;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
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
 * @property string $helpGallery
 * @property string $previewImageHelper
 * @property string $gallery
 */
class BaseActiveRecord extends ActiveRecord
{

    public $title;
    public $previewImageHelper;
    public $helpGallery;

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

    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    public function getModifier()
    {
        return $this->hasOne(User::class, ['id' => 'modifier_id']);
    }

    public function getEnable()
    {
        return @self::listsEnabled()[$this->enabled];
    }

    public function getOrder()
    {
        return $this->order ?? 500;
    }

    public static function listsEnabled()
    {
        return [
            1 => Yii::t('main', 'Фаол'),
            0 => Yii::t('main', 'Ўчирилган')
        ];
    }

    public static function uploadImagePath()
    {
        return Yii::getAlias('@frontend') . '/web/uploads/';
    }

    public static function imageSourcePath()
    {
        return 'http://' . Yii::$app->params['domainName'] . '/uploads/';
    }

    public static function getUrlToFrontend($route, $params)
    {
        return 'http://' . Yii::$app->params['domainName'] . $route . http_build_query($params);
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

    public function uploadImage($fileInput, $field, $table = '')
    {
        $image = UploadedFile::getInstance($this, $fileInput);
        if ($image) {
            if (!$this->isNewRecord) {
                if (!empty($this->$field)) {
                    $oldImage = $this->uploadImagePath() . $this->$field;
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
            }

            $imageName = $table . '_' . $this->id . '_' . $this->createGuid() . '.' . $image->getExtension();
            $this->$field = $imageName;
            $this->updateAttributes([$field]);
            $imagePath = $this->uploadImagePath() . $imageName;

            if (!$image->saveAs($imagePath))
                DebugHelper::printSingleObject($image->error, 1);
        }
    }

    public function uploadGallery($fileInput, $field, $table = '')
    {
        $images = UploadedFile::getInstances($this, $fileInput);
        if ($images) {
            if (!$this->isNewRecord && !empty($this->$field)) {
                $folderName = $this->$field;
            } else {
                $folderName = $table . '_' . $this->id . '_' . self::createGuid();
                mkdir(self::uploadImagePath() . $folderName);
                $this->$field = $folderName;
                $this->updateAttributes([$field]);
            }
            foreach ($images as $key => $image) {
                $imageName = str_pad($key, 3, '0', STR_PAD_LEFT) . '_' . self::createGuid() . '_' . $table . '.' . $image->getExtension();
                $imagePath = self::uploadImagePath() . $folderName . '/' . $imageName;
                $image->saveAs($imagePath);
            }
        }
    }

    public function inputImageConfig($field, $deleteUrl)
    {
        $config = ['path' => [], 'config' => []];
        if (!$this->isNewRecord && !empty($this->$field)) {
            $image = $this->$field;
            $file = $this->uploadImagePath() . $image;
            if (file_exists($file)) {
                $config['path'] = ['http://' . Yii::$app->params['domainName'] . '/uploads/' . $this->$field];
                $config['config'] = [
                    [
                        'caption' => $image,
                        'size' => filesize($file),
                        'url' => Url::to([$deleteUrl]),
                        'key' => $this->$field,
                        'extra' => [
                            'id' => $this->id,
                            'field' => $field,
                            'className' => get_called_class()
                        ],
                    ]
                ];
            }
        }
        return $config;
    }

    public function inputGalleryConfig($delUrl)
    {
        $config = [
            'path' => [],
            'config' => []
        ];
        if (!$this->isNewRecord && !empty($this->gallery)) {

            $files = glob(self::uploadImagePath() . $this->gallery . Yii::$app->params['allowedImageExtension'], GLOB_BRACE);

            foreach ($files as $file) {
                $filePath = explode('/', $file);
                $imageName = end($filePath);
                if (file_exists($file)) {
                    $config['path'][] = Url::to(self::imageSourcePath() . $this->gallery . '/' . $imageName);
                    $config['config'][] = [
                        'caption' => $imageName,
                        'size' => filesize($file),
                        'url' => Url::to([$delUrl]),
                        'key' => $this->gallery,
                        'extra' => [
                            'id' => $this->id,
                            'count' => count($files),
                            'imageName' => $imageName,
                            'className' => get_called_class()
                        ],
                    ];
                }
            }
        }
        return $config;
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

    public static function selectText()
    {
        return Yii::t('main', 'Танланг') . ' ...';
    }

    public static function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            throw new NotFoundHttpException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public static function ckEditorConfig($key)
    {
        return [
            'options' => [
                'id' => 'CK-' . $key
            ],
            'preset' => 'custom',
            'clientOptions' => [
                'allowedContent' => true,
                'height' => 400,
                'language' => 'en',
                'extraPlugins' => 'font,smiley,colorbutton,iframe,selectall,copyformatting,justify',
                'removeButtons' => 'About,Anchor,Styles,Font',
                "toolbarGroups" => [
                    ['name' => 'document', 'groups' => ['mode']],
                    ['name' => 'clipboard', 'groups' => ['undo', 'clipboard']],
                    ['name' => 'editing', 'groups' => ['find', 'selection', 'editing']],
                    ['name' => 'links', 'groups' => ['links']],
                    ['name' => 'insert', 'groups' => ['insert']],
                    ['name' => 'colors', 'groups' => ['colors']],
                    '/',
                    ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                    ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'paragraph']],
                    ['name' => 'styles', 'groups' => ['styles']]
                ],
                'toolbar' => [
                    ['name' => 'document', 'items' => ['Source']],
                    ['name' => 'clipboard', 'items' => ['Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord']],
                    ['name' => 'editing', 'items' => ['SelectAll']],
                    ['name' => 'links', 'items' => ['Link', 'Unlink']],
                    ['name' => 'insert', 'items' => ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'Iframe']],
                    ['name' => 'colors', 'items' => ['TextColor', 'BGColor']],
                    ['name' => 'tools', 'items' => ['Maximize']],
                    '/',
                    ['name' => 'basicstyles', 'items' => ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']],
                    ['name' => 'paragraph', 'items' => ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']],
                    ['name' => 'styles', 'items' => ['Format', 'FontSize']]
                ],
            ],
        ];
    }

}