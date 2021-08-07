<?php

namespace common\modules\i18n_interface\controllers;

use common\helpers\DebugHelper;
use common\modules\i18n_interface\models\Message;
use Yii;
use common\modules\i18n_interface\models\SourceMessage;
use common\modules\i18n_interface\models\SourceMessageSearch;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SourceMessageController implements the CRUD actions for SourceMessage model.
 */
class SourceMessageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SourceMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SourceMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SourceMessage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SourceMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SourceMessage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SourceMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SourceMessage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SourceMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SourceMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SourceMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport()
    {
        $uzAppMessages = $this->loadMessagesFromFile($this->getMessageFilePath('main', 'uz'));
        $ruAppMessages = $this->loadMessagesFromFile($this->getMessageFilePath('main', 'ru'));
        $ozAppMessages = $this->loadMessagesFromFile($this->getMessageFilePath('main', 'oz'));
        $enAppMessages = $this->loadMessagesFromFile($this->getMessageFilePath('main', 'en'));
        $uzYiiMessages = $this->loadMessagesFromFile($this->getMessageFilePath('yii', 'uz'));
        $ruYiiMessages = $this->loadMessagesFromFile($this->getMessageFilePath('yii', 'ru'));
        $enYiiMessages = $this->loadMessagesFromFile($this->getMessageFilePath('yii', 'en'));
        $ozYiiMessages = $this->loadMessagesFromFile($this->getMessageFilePath('yii', 'oz'));
        $messageSources = [];
        foreach ($uzAppMessages as $source => $message)
            $messageSources['app'][$source]['uz'] = $message;
        foreach ($uzYiiMessages as $source => $message)
            $messageSources['yii'][$source]['uz'] = $message;
        foreach ($ruAppMessages as $source => $message)
            $messageSources['app'][$source]['ru'] = $message;
        foreach ($ruYiiMessages as $source => $message)
            $messageSources['yii'][$source]['ru'] = $message;
        foreach ($ozAppMessages as $source => $message)
            $messageSources['app'][$source]['oz'] = $message;
        foreach ($ozYiiMessages as $source => $message)
            $messageSources['yii'][$source]['oz'] = $message;
        foreach ($enAppMessages as $source => $message)
            $messageSources['app'][$source]['en'] = $message;
        foreach ($enYiiMessages as $source => $message)
            $messageSources['yii'][$source]['en'] = $message;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($messageSources as $category => $sources) {
                foreach ($sources as $source => $langMessages) {
                    /** @var SourceMessage $modelSource */
                    $modelSource = new SourceMessage();
                    $modelSource->category = $category;
                    $modelSource->message = $source;
                    if (!$modelSource->save()) {
                        $transaction->rollBack();
                        DebugHelper::printSingleObject($modelSource->getErrors());
                        return;
                    }
                    foreach ($langMessages as $lang => $message) {
                        $messageModel = new Message();
                        $messageModel->id = $modelSource->id;
                        $messageModel->language = $lang;
                        $messageModel->translation = $message;
                        if (!$messageModel->save()) {
                            $transaction->rollBack();
                            DebugHelper::printSingleObject($messageModel->getErrors());
                            return;
                        }
                    }
                }
            }
            $transaction->commit();
            echo 'SUCCESS';
            return;
        } catch (\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        } catch (\Throwable $e) {
            $transaction->rollBack();
        }

    }

    /**
     * Returns message file path for the specified language and category.
     *
     * @param string $category the message category
     * @param string $language the target language
     * @return string path to message file
     */
    public function getMessageFilePath($category, $language)
    {
        $messageFile = Yii::getAlias('@common/messages') . "/$language/$category.php";
        return $messageFile;
    }

    /**
     * Loads the message translation for the specified language and category or returns null if file doesn't exist.
     *
     * @param string $messageFile path to message file
     * @return array|null array of messages or null if file not found
     */
    public function loadMessagesFromFile($messageFile)
    {
        if (is_file($messageFile)) {
            $messages = include $messageFile;
            if (!is_array($messages)) {
                $messages = [];
            }
            return $messages;
        }
        return null;
    }

    public function actionBuild()
    {
        $categories = (new SourceMessage())->getCategories();
        $languages = ['uz', 'ru', 'en', 'oz'];
        foreach ($languages as $language) {
            foreach ($categories as $category) {
                $fileName = $this->getMessageFilePath($category, $language);
                if (file_exists($fileName))
                    unlink($fileName);
                $messages = Message::find()->alias('m')->select(new Expression("s.message AS key,m.translation AS value"))->innerJoin('source_message s', "m.id=s.id")->where(['m.language' => $language, 's.category' => $category])->asArray()->all();
                $fh = fopen($fileName, "w");
                if (!is_resource($fh)) {
                    return false;
                }
                fwrite($fh, $this->renderPartial('template/lang_file', ['messages' => $messages]));
                fclose($fh);
            }
        }
        Yii::$app->session->setFlash('success','Success');
        $this->redirect('index');
    }

}
