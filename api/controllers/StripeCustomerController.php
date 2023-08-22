<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\stripe_customer\Small;
use api\components\stripe\StripeRequest;
use common\models\StripeCustomer;
use Yii;
use yii\web\NotFoundHttpException;

class StripeCustomerController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * @OA\Post(
     *     path="/stripe/customer",
     *     tags={"stripe"},
     *     operationId="createStripeCustomer",
     *     summary="createCustomer",
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
     *         {"main":{}},
     *     }
     * )
     */
    public function actionCreate()
    {
        $model = new StripeCustomer();
        $user = Yii::$app->user->identity;

        $stripe = new StripeRequest();
        $stripe->createCustomer($user);

        $model->user_id = $user['id'];
        $model->cus_id = $stripe->customer->id;

        if (!$model->save()) {
            throw new HttpException(400, $model->getErrors());
        }

        return $this->success(($model->getAsArray(Small::class)));
    }
    /**
     * @OA\Get (
     *     path="/stripe/customer",
     *     tags={"stripe"},
     *     operationId="getStripeCustomer",
     *     summary="getCustomer",
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
     *         {"main":{}},
     *     }
     * )
     */

    public function actionShow()
    {
        $user = Yii::$app->user->identity;
        $model = StripeCustomer::findByUserID($user['id']);
        if(!$model) {
            throw new NotFoundHttpException('Stripe customer not found');
        }

        return $this->success(($model->getAsArray(Small::class)));
    }

}
