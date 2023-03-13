<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadOrdinaryReferenceNumberService;
use api\templates\load_ordinary_reference_number\Large;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class OrdinaryLoadReferenceNumberController extends BaseController
{
    public $loadOrdinaryReferenceNumber;


    public function __construct($id, $module, $config = [],
                                LoadOrdinaryReferenceNumberService $loadOrdinaryReferenceNumber

    )
    {
        parent::__construct($id, $module, $config);
        $this->loadOrdinaryReferenceNumber = $loadOrdinaryReferenceNumber;

    }

    /**
     * @OA\Post(
     *     path="/ordinary-load-reference-number",
     *     tags={"ordinary-load"},
     *     operationId="createOrdinaryLoadReferenceNumber",
     *     summary="createOrdinaryLoadReferenceNumber",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="load_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="seal",
     *                     type="string",
     *                     example="seal",
     *                     description="seal"
     *                 ),
     *                  @OA\Property(
     *                     property="pick_up",
     *                     type="string",
     *                     example="pick_up",
     *                     description="pick_up"
     *                 ),
     *                  @OA\Property(
     *                     property="appointment",
     *                     type="string",
     *                     example="appointment",
     *                     description="appointment"
     *                 ),
     *                 @OA\Property(
     *                     property="reservation",
     *                     type="string",
     *                     example="reservation",
     *                     description="reservation"
     *                 ),
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
     *         @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadOrdinaryReferenceNumberLarge"
     *             )
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
        $model = $this->loadOrdinaryReferenceNumber->create();
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Patch (
     *     path="/ordinary-load-reference-number/{id}",
     *     tags={"ordinary-load-reference-number"},
     *     operationId="updateOrdinaryLoadReferenceNumber",
     *     summary="updateOrdinaryLoadReferenceNumber",
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
     *                  @OA\Property(
     *                     property="seal",
     *                     type="string",
     *                     example="seal",
     *                     description="seal"
     *                 ),
     *                  @OA\Property(
     *                     property="pick_up",
     *                     type="string",
     *                     example="pick_up",
     *                     description="pick_up"
     *                 ),
     *                  @OA\Property(
     *                     property="appointment",
     *                     type="string",
     *                     example="appointment",
     *                     description="appointment"
     *                 ),
     *                 @OA\Property(
     *                     property="reservation",
     *                     type="string",
     *                     example="reservation",
     *                     description="reservation"
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
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadOrdinaryReferenceNumberLarge"
     *             )
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

        $this->loadOrdinaryReferenceNumber->update($id);
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/ordinary-load-reference-number/{id}",
     *     tags={"ordinary-load-reference-number"},
     *     operationId="deleteOrdinaryLoadReferenceNumber",
     *     summary="deleteOrdinaryLoadReferenceNumber",
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
     */

    public function actionDelete($id): array
    {
        $this->loadOrdinaryReferenceNumber->delete($id);
        return $this->success();
    }
}