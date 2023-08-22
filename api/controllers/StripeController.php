<?php

namespace api\controllers;
use Yii;
use yii\web\NotFoundHttpException;

class StripeController extends \api\controllers\BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * @OA\Get (
     *     path="/stripe/public-key",
     *     tags={"stripe"},
     *     operationId="getStripePublicKey",
     *     summary="getStripePublicKey",
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}}
     *     }
     * )
     */
    public function actionPublicKey()
    {
        $public_key = Yii::$app->params['STRIPE_PK'];
        if ($public_key) {
            return $this->success(['public_key' => $public_key]);
        } else {
            throw new NotFoundHttpException();
        }
    }

}
