<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadReferenceNumberService;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;


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
        try {
            $this->loadReference->update($id);
        } catch (HttpException $e) {
        } catch (InvalidConfigException $e) {
        } catch (StaleObjectException $e) {
        }
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
        $this->loadReference->delete($id);
        return $this->success();
    }
}