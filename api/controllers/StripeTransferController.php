<?php

namespace api\controllers;

use api\components\stripe\StripeRequest;
use common\models\StripeCustomer;
use Yii;

class StripeTransferController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * @OA\Post(
     *     path="/stripe/transfer",
     *     tags={"stripe"},
     *     operationId="createACHTransfer",
     *     summary="createACHTransfer",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="amount",
     *                  type="integer",
     *              ),
     *          )
     *      ),
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
     *          {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $user = Yii::$app->user->identity;
        $model = StripeCustomer::findByUserID($user['id']);
        $ach = new StripeRequest();
        $response = $ach->sendACHRequest($model->cus_id, $post['amount']);
        return $this->success($response);
    }
}
