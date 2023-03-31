<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\billing\BillingCreateForm;
use api\forms\billing\BillingUpdateForm;
use api\khalsa\services\BillingService;
use api\khalsa\services\ContainerLoadService;
use api\khalsa\services\OrdinaryLoadService;
use api\templates\billing\Large;
use api\templates\billing\Small;
use common\models\Billing;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;

class BillingController extends BaseController
{
    public $service;
    public $containerLoadService;
    public $ordinaryLoadService;
    public function __construct
    (
        $id,
        $module,
        $config = [],
        BillingService $service,
        ContainerLoadService $containerLoadService,
        OrdinaryLoadService $ordinaryLoadService
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->containerLoadService = $containerLoadService;
        $this->ordinaryLoadService = $ordinaryLoadService;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @OA\Post(
     *      path="/billing",
     *      tags={"billing"},
     *      operationId="createBilling",
     *      summary="createBilling",
     *      requestBody={"$ref":"#/components/requestBodies/BillingCreateForm"},
     *      @OA\Response(
     *          response=200,
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/BillingSmall"
     *              )
     *          )
     *     ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     * )
     * @throws HttpException
     * @throws Exception|InvalidConfigException
     */
    public function actionCreate(): array
    {
        $form = new BillingCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $transaction = Yii::$app->db->beginTransaction();

            $model = new Billing();
            $model->note = $form->note;
            $this->service->create($model);

            if ($form->is_container) {
                $load = $this->containerLoadService->repository->getById($form->load_id);
                $load->billing_id = $model->id;
                $this->containerLoadService->update($load);
            } else {
                $load = $this->ordinaryLoadService->repository->getById($form->load_id);
                $load->billing_id = $model->id;
                $this->ordinaryLoadService->update($load);
            }

            $transaction->commit();
        } else {
            throw new HttpException(400, [$form->formName() => $form->errors]);
        }

        return $this->success($model->getAsArray(Small::class));
    }

    /**
     * @OA\Get(
     *     path="/billing/{load_id}",
     *     tags={"billing"},
     *     operationId="getBilling",
     *     summary="getBilling",
     *     @OA\Parameter (
     *          name="load_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema (
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter (
     *          name="is_container",
     *          in="query",
     *          required=true,
     *          @OA\Schema (
     *              type="boolean"
     *          )
     *     ),
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
     *                 ref="#/components/schemas/BillingLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     * @throws HttpException
     */
    public function actionView($load_id): array
    {
        $is_container = Yii::$app->request->queryParams['is_container'];
        if ($is_container == "true") {
            $load = $this->containerLoadService->repository->getById($load_id);
        } else {
            $load = $this->ordinaryLoadService->repository->getById($load_id);
        }

        $model = $this->service->repository->getWithDetail($load->billing_id);
        return $this->index($model, 0, 10, Large::class);
    }

    /**
     * @OA\Patch (
     *      path="/billing",
     *      tags={"billing"},
     *      operationId="updateBilling",
     *      summary="updateBilling",
     *      requestBody={"$ref":"#/components/requestBodies/BillingUpdateForm"},
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
    public function actionUpdate(): array
    {
        $form = new BillingUpdateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if($form->is_container) {
                $billing_id = $this->containerLoadService->repository->getById($form->load_id)->billing_id;
            } else {
                $billing_id = $this->ordinaryLoadService->repository->getById($form->load_id)->billing_id;
            }
            $model = $this->service->repository->getById($billing_id);
            $model->note = $form->note;
            $this->service->update($model);
        } else {
            throw new HttpException(400, [$form->formName() => $form->errors]);
        }
        return $this->success();
    }
}
