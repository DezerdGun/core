<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\billing\BillingDetailForm;
use api\khalsa\services\BillingDetailService;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;

class BillingDetailController extends \api\controllers\BaseController
{
    public $service;
    public function __construct(
        $id,
        $module,
        $config = [],
        BillingDetailService $service
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * @OA\Post(
     *      path="/billing/detail/{billing_id}",
     *      tags={"billing-detail"},
     *      operationId="createBillingDetail",
     *      summary="createBillingDetail",
     *      @OA\Parameter(
     *          name="billing_id",
     *          in="path",
     *          required=false,
     *          @OA\Schema(
     *              type="integer",
     *         )
     *      ),
     *      requestBody={"$ref":"#/components/requestBodies/BillingDetailForm"},
     *      @OA\Response(
     *          response=200,
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     * )
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate($billing_id): array
    {
        $form = new BillingDetailForm();
        $form->billing_id = $billing_id;
        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            $this->service->create($form);
        } else {
            throw new HttpException(400, [$form->formName() => $form->errors]);
        }
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/billing/detail/{id}",
     *     tags={"billing-detail"},
     *     operationId="deleteBillingDetail",
     *     summary="deleteBillingDetail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="integer",
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     * @throws Exception
     * @throws HttpException
     */
    public function actionDelete($id): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->service->delete($id);
        $transaction->commit();
        return $this->success();
    }

    /**
     * @OA\Patch (
     *      path="/billing/detail/{id}",
     *      tags={"billing-detail"},
     *      operationId="updateBillingDetail",
     *      summary="updateBillingDetail",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(
     *                  type="integer",
     *              )
     *          )
     *      ),
     *      requestBody={"$ref":"#/components/requestBodies/BillingDetailForm"},
     *      @OA\Response(
     *          response=200,
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     * @throws HttpException|InvalidConfigException
     */
    public function actionUpdate($id): array
    {
        $form = new BillingDetailForm();
        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            $this->service->update($form, $id);
        } else {
            throw new HttpException(400, [$form->formName() => $form->errors]);
        }
        return $this->success();
    }
}
