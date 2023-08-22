<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadReferenceNumberService;
use api\templates\load_container_reference_number\Large;
use common\models\LoadContainerInfo;
use common\models\LoadReferenceNumber;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;


class LoadReferenceNumberController extends BaseController
{

    public $loadReference;
    public function __construct($id, $module, $config = [], LoadReferenceNumberService $loadReference)
    {
        parent::__construct($id, $module, $config);
        $this->loadReference = $loadReference;
    }

    /**
     * @OA\Post(
     *     path="/load-reference-number",
     *     tags={"load-container-info-reference-number"},
     *     operationId="createLoadReferenceNumber",
     *     summary="createLoadReferenceNumber",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="load_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="master_bill_of_loading",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="house_bill_of_loading",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="seal",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="vessel_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="voyage",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="purchase_order",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="shipment",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="pick_up",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="appointment",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="return",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="reservation",
     *                     type="string"
     *                 ),
     *               required={
     *                     "load_id",
     *              }
     *             )
     *         )
     *     ),
     *       @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate(): array
    {
        $this->loadReference->create();
        return $this->success();
    }

    /**
     * @OA\Patch (
     *     path="/load-reference-number/{id}",
     *     tags={"load-container-info-reference-number"},
     *     operationId="updateLoadReferenceNumber",
     *     summary="updateLoadReferenceNumber",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *          type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="mbl",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="hbl",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="seal",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="vessel_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="voyage",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="purchase_order",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="shipment",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="pick_up",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="appointment",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="return",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="reservation",
     *                     type="string"
     *                 ),
     *            )
     *         )
     *     ),
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
     *                  type="string",
     *                  example="Load-reference-number {fk} to load-container-info{id}"
     *              ),
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */

    public function actionUpdate($id): array
    {
        $num = $this->search($id);
        $num->setAttributes(\Yii::$app->request->post());
        if ($num->validate()) {
            $num->update();
        } else throw new HttpException(400, [$num->formName() => $num->getErrors()]);

        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/load-reference-number/{id}",
     *     tags={"load-container-info-reference-number"},
     *     operationId="deleteLoadReferenceNumber",
     *     summary="deleteLoadReferenceNumber",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
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
     * @throws StaleObjectException
     */

    public function actionDelete($id): array
    {
        $del = $this->search($id);
        $del->delete();
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/load-reference-number/{id}",
     *     tags={"load-container-info-reference-number"},
     *     operationId="getLoadReferenceNumberId",
     *     summary="getLoadReferenceNumberId",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
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
     *                 ref="#/components/schemas/LoadReferenceNumberLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionShow($id)
    {
        $model = $this->search($id);
        return $this->success($model->getAsArray(Large::class));
    }

    private function search($id)
    {
        $con = ['load_id' => $id];
        $model = LoadContainerInfo::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $refer = ['load_id' => $model->id];
        $num = LoadReferenceNumber::findOne($refer);
        if (!$num) {
            throw new NotFoundHttpException();
        }
        return $num;
    }
}