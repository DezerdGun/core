<?php

namespace api\controllers;

use api\khalsa\repositories\CarrierRepository;
use api\khalsa\services\CarrierService;
use api\templates\carrier_document\Large;
use common\models\Carrier;

class CarrierDocumentController extends \api\controllers\BaseController
{
    public $carrierService;
    public $carrierRepository;

    public function __construct(
        $id,
        $module,
        $config = [],
        CarrierService $carrierService,
        CarrierRepository $carrierRepository
    )
    {
        parent::__construct($id, $module, $config);
        $this->carrierService = $carrierService;
        $this->carrierRepository = $carrierRepository;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @OA\Patch (
     *     path="/carrier/document/w9",
     *     tags={"carrier"},
     *     operationId="updateCarrierDocumentW9",
     *     summary="updateCarrierDocumentW9",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="Carrier[w9_file]",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *                  required={
     *                      "Carrier[w9_file]",
     *                  }
     *              )
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
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */
    public function actionUpdateW9()
    {
        $this->carrierService->updateW9();
        return $this->success();
    }
    /**
     * @OA\Get(
     *     path="/carrier/document",
     *     tags={"carrier"},
     *     operationId="getCarrierDocument",
     *     summary="getCarrierDocument",
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
     *                 ref="#/components/schemas/CarrierDocumentLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionView()
    {
        $user_id = \Yii::$app->user->id;

        $model = $this->carrierRepository->getByUserId($user_id);

        return $this->success($model->getAsArray(Large::class));
    }
    /**
     * @OA\Patch (
     *     path="/carrier/document/ic",
     *     tags={"carrier"},
     *     operationId="updateCarrierDocumentIc",
     *     summary="updateCarrierDocumentIc",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="Carrier[ic_file]",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *                  required={
     *                      "Carrier[ic_file]",
     *                  }
     *              )
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
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */
    public function actionUpdateIc()
    {
        $this->carrierService->updateIc();
        return $this->success();
    }
}
