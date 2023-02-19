<?php

namespace api\controllers;

use api\forms\company\CompanyCreateForm;
use api\components\HttpException;
use api\forms\customer\CustomerDeleteForm;
use api\khalsa\services\CustomerService;
use api\templates\customer\Small;
use api\templates\customer\Large;
use common\models\search\SearchCustomer;
use Yii;
use common\models\Customer;

class CustomerController extends BaseController
{
    private $customerService;

    public function __construct(
        $id,
        $module,
        $config = [],
        CustomerService $customerService
    ){
        parent::__construct($id, $module, $config);
        $this->customerService = $customerService;
    }
    /**
     * @OA\Get(
     *     path="/customer",
     *     tags={"customer"},
     *     operationId="getCustomers",
     *     summary="getCustomers",
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"Load owner","Broker", "Trucker"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="company_name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=0
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page_size",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=10
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CustomerSmall")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 ref="#/components/schemas/Pagination"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionIndex($page = 0, $page_size = 10): array
    {
        $searchCustomer = new SearchCustomer();
        $params = [
            'SearchCustomer' => Yii::$app->request->queryParams
        ];
        if ($searchCustomer->load($params) && $searchCustomer->validate()) {
            $query = $searchCustomer->search();
        } else {
            throw new HttpException(400, ['SearchLocation' => $searchCustomer->getErrors()]);
        }

        return $this->index($query, $page, $page_size, Small::class);
    }
    /**
     * @OA\Post(
     *     path="/customer",
     *     tags={"customer"},
     *     operationId="Customer",
     *     summary="createCustomer",
     *
     * @OA\RequestBody(
     *     request="CarrierCreateForm",
     *     required=true,
     *      @OA\MediaType(
     *      mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="Customer[type]",
     *                  type="string",
     *                  enum={"Load owner","Broker", "Trucker"}
     *               ),
     *              @OA\Property(
     *                  property="Company[company_name]",
     *                  type="string",
     *                  example="Omega Global",
     *               ),
     *              @OA\Property(
     *                  property="Company[mc_number]",
     *                  type="string",
     *                  example="8054684",
     *               ),
     *              @OA\Property(
     *                  property="Company[dot]",
     *                  type="string",
     *                  example="875682",
     *               ),
     *              @OA\Property(
     *                  property="Company[ein]",
     *                  type="string",
     *                  example="53-2307147",
     *               ),
     *              @OA\Property(
     *                  property="Address[street_address]",
     *                  type="string",
     *                  example="319 Ridge Rd",
     *               ),
     *              @OA\Property(
     *                  property="Address[city]",
     *                  type="string",
     *                   example="South San Francisco",
     *               ),
     *              @OA\Property(
     *                  property="Address[state_code]",
     *                  type="string",
     *                  example="CA",
     *               ),
     *              @OA\Property(
     *                  property="Address[zip]",
     *                  type="string",
     *                  example="35210",
     *               ),
     *              @OA\Property(
     *                  property="Customer[contact_name]",
     *                  type="stirng",
     *                  example="John",
     *              ),
     *              @OA\Property(
     *                  property="Customer[job_title]",
     *                  type="stirng",
     *                  example="Manager"
     *              ),
     *              @OA\Property(
     *                  property="ContactInfo[main_phone_number]",
     *                  type="stirng",
     *                  example="(205) 555-0100"
     *              ),
     *              @OA\Property(
     *                  property="ContactInfo[additional_phone_number]",
     *                  type="stirng",
     *                  example="(205) 555-0102"
     *              ),
     *              @OA\Property(
     *                  property="ContactInfo[main_email]",
     *                  type="stirng",
     *                  example="felicia.reid@example.com"
     *              ),
     *              @OA\Property(
     *                   property="ContactInfo[additional_email]",
     *                   type="stirng",
     *                   example="felicia.reid@example.com"
     *              ),
     *              required={
     *                  "Customer[type]",
     *                  "Company[company_name]",
     *                  "Address[street_address]",
     *                  "Address[city]",
     *                  "Address[state_code]",
     *                  "Address[zip]",
     *                  "Customer[contact_name]",
     *                  "ContactInfo[main_phone_number]",
     *                  "ContactInfo[main_email]",
     *              }
     *          )
     *     )
     * ),
     *
     *       @OA\Response(
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
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionCreate(): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->customerService->create();
        $transaction->commit();
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/customer/{id}",
     *     tags={"customer"},
     *     operationId="deleteCustomer",
     *     summary="deleteCustomer",
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
     * @throws HttpException
     */

    public function actionDelete($id): array
    {
        $form = new CustomerDeleteForm();
        $form->id = $id;
        if ($form->validate()) {
           $this->customerService->delete($id);
        } else {
            throw new HttpException(400, [$form->getErrors()]);
        }

        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/customer/{id}",
     *     tags={"customer"},
     *     operationId="getCustomer",
     *     summary="getCustomer",
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/CustomerLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     */
    public function actionShow($id): array
    {
        $model = $this->customerService->show($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Patch (
     *     path="/customer/{id}",
     *     tags={"customer"},
     *     operationId="patchCustomer",
     *     summary="patchCustomer",
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
     *              @OA\Property(
     *                  property="Customer[type]",
     *                  type="string",
     *                  enum={"Load owner","Broker", "Trucker"}
     *               ),
     *              @OA\Property(
     *                  property="Company[company_name]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Company[mc_number]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Company[dot]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Company[ein]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Address[street_address]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Address[city]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Address[state_code]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Address[zip]",
     *                  type="string",
     *               ),
     *              @OA\Property(
     *                  property="Customer[contact_name]",
     *                  type="stirng",
     *              ),
     *              @OA\Property(
     *                  property="Customer[job_title]",
     *                  type="stirng",
     *              ),
     *              @OA\Property(
     *                  property="ContactInfo[main_phone_number]",
     *                  type="stirng",
     *              ),
     *              @OA\Property(
     *                  property="ContactInfo[additional_phone_number]",
     *                  type="stirng",
     *              ),
     *              @OA\Property(
     *                  property="ContactInfo[main_email]",
     *                  type="stirng",
     *              ),
     *              @OA\Property(
     *                   property="ContactInfo[additional_email]",
     *                   type="stirng",
     *              ),
     *              required={
     *                  "Customer[type]",
     *                  "Company[company_name]",
     *                  "Address[street_address]",
     *                  "Address[city]",
     *                  "Address[state_code]",
     *                  "Address[zip]",
     *                  "Customer[contact_name]",
     *                  "ContactInfo[main_phone_number]",
     *                  "ContactInfo[main_email]",
     *              }
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
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */

    public function actionUpdate($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->customerService->update($id);
        $transaction->commit();
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/customer/count",
     *     tags={"customer"},
     *     operationId="countCustomerTypes",
     *     summary="countCustomerTypes",
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
     *                 type="array",
     *                 @OA\Items(
     *                      @OA\Property(
     *                          property="type",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="number",
     *                          type="integer"
     *                      ),
     *                 )
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionCount(): array
    {
       $data = Customer::countTypes();
        return $this->success($data);
    }
}
