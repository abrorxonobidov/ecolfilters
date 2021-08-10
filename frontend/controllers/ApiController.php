<?php

namespace frontend\controllers;

use common\models\Reviews;
use common\models\ReviewsSearch;
use yii\rest\Controller;
use Yii;

class ApiController extends Controller
{

    public function actionReviews($pid, $offset = 0)
    {
        $reviews = ReviewsSearch::getByProduct($pid, $offset);
        return [
            'count' => count($reviews) > 0,
            'html' => $this->renderPartial('reviews', [
                'reviews' => $reviews
            ]),
            'text' => count($reviews) > 0 ? '' : Yii::t('main', 'Маълумот топилмади')
        ];
    }

    public function actionSendReview()
    {
        $review = new Reviews();

        if ($review->load(Yii::$app->request->post()))
            return $review->save() ?
                $this->success(Yii::t('main', 'Изоҳингиз қабул қилинди. Раҳмат')) :
                $this->error(implode('; ', $review->getErrorSummary(1)));

        return $this->error(Yii::t('main', 'Маълумотни қабул қилишда хатолик юз берди. Илтимос, қайта уриниб кўринг'));
    }

    public function success($text = null)
    {
        return [
            'status' => 1,
            'text' => $text
        ];
    }

    public function error($text = null)
    {
        return [
            'status' => -1,
            'text' => $text
        ];
    }
}