<?php

namespace api\templates\load;

use common\models\Company;
use common\models\Load;
use common\models\LoadStop;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="LoadSmall",
 *     @OA\Property(
 *          property="id",
 *          type="object",
 *          description="Object",
 *             @OA\Property(
 *                 property="port_id",
 *                 type="integer"
 *         ),
 *             @OA\Property(
 *                 property="stop_type",
 *                 type="string"
 *         ),
 *            @OA\Property(
 *                 property="company",
 *                 type="object",
 *            @OA\Property(
 *                 property="company_name",
 *                 type="string"
 *              ),
 *            @OA\Property(
 *                 property="business_phone",
 *                 type="string"
 *              ),
 *            @OA\Property(
 *                 property="ein",
 *                 type="string"
 *              ),
 *            @OA\Property(
 *                 property="w9_file",
 *                 type="string"
 *              ),
 *             @OA\Property(
 *                 property="ic_file",
 *                 type="string"
 *              ),
 *             @OA\Property(
 *                 property="address_id",
 *                 type="integer"
 *              ),
 *              @OA\Property(
 *                 property="mc_number",
 *                 type="string"
 *              ),
 *              @OA\Property(
 *                 property="email",
 *                 type="string"
 *              ),
 *              @OA\Property(
 *                 property="receiver_email",
 *                 type="string"
 *              ),
 *             @OA\Property(
 *                 property="billing_email",
 *                 type="string"
 *              ),
 *            @OA\Property(
 *                 property="quickbooks_email",
 *                 type="string"
 *              ),
 *           @OA\Property(
 *                 property="credit_limit",
 *                 type="string"
 *              ),
 *            @OA\Property(
 *                 property="payment_terms",
 *                 type="string"
 *              ),
 *            @OA\Property(
 *                 property="ic_customer",
 *                 type="boolean"
 *              ),
 *             @OA\Property(
 *                 property="ic_port",
 *                 type="boolean"
 *              ),
 *             @OA\Property(
 *                 property="ic_consignee",
 *                 type="string"
 *              ),
 *             @OA\Property(
 *                 property="ic_chassis",
 *                 type="string"
 *              ),
 *         ),
 *            @OA\Property(
 *                 property="from",
 *                 type="string"
 *         ),
 *            @OA\Property(
 *                 property="to",
 *                 type="string"
 *         ),
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Load $model */
        $model = $this->model;
        $this->result = [
            'id' => [
                $model->id,
                LoadStop::find()->where(['port_id' => $model->id])->all()
            ],
            'load_type' => $model->load_type,
            'customer_id' => [
                $model->customer_id,
                Company::find()
                    ->where(['id' => $model->customer_id])->all()

            ],
            'port_id' => [
                $model->port_id,
                LoadStop::find()
                    ->where(['id' => $model->port_id])->all()
            ],
            'consignee_id' => [
                $model->consignee_id,
                Company::find()
                    ->where([
                        'id' => $model->consignee_id
                    ])
                    ->all()
            ],
            'route_type' => $model->route_type,
            'order' => $model->order,
        ];
    }
}
