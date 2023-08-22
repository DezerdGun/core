<?php

namespace api\templates\billing;

use common\models\Billing;
/**
 *
 * @OA\Schema(
 *      schema="BillingLarge",
 *      @OA\Property(
 *          property="note",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="billing_detail",
 *          type="array",
 *          @OA\Items (
 *              @OA\Property (
 *                  property="billing_detail_id",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="charge",
 *                  type="object",
 *                  @OA\Property(
 *                      property="charge_id",
 *                      type="integer"
 *                  ),
 *                  @OA\Property(
 *                      property="charge_name",
 *                      type="string"
 *                  )
 *              ),
 *              @OA\Property(
 *                  property="desription",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="price",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="unit_count",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="measure",
 *                  type="object",
 *                  @OA\Property(
 *                      property="measure_id",
 *                      type="integer"
 *                  ),
 *                  @OA\Property(
 *                      property="measure_name",
 *                      type="string"
 *                  )
 *              ),
 *              @OA\Property(
 *                  property="free_unit",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="per_unit",
 *                  type="integer"
 *              )
 *          )
 *      ),
 *          @OA\Property(
 *              property="created_at",
 *              type="string"
 *          ),
 * )
 */
class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var Billing $model */
        $model = $this->model;
        $billing_description = [];
        for ($i = 0; $i < count($model->billingDetails); $i++) {
            $billing_description[] = [
                'billing_detail_id' => $model->billingDetails[$i]->id,
                'charge' => [
                    'charge_id' => $model->billingDetails[$i]->charge->id,
                    'charge_name' => $model->billingDetails[$i]->charge->name
                ],
                'description' => $model->billingDetails[$i]->description,
                'price' => $model->billingDetails[$i]->price,
                'unit_count' => $model->billingDetails[$i]->unit_count,
                'measure' => [
                    'measure_id' => $model->billingDetails[$i]->measure->id,
                    'measure_name' => $model->billingDetails[$i]->measure->name,
                ],
                'free_unit' => $model->billingDetails[$i]->free_unit,
                'per_unit' => $model->billingDetails[$i]->per_unit,
            ];
        }
        $this->result = [
            'note' => $model->note,
            'billing_detail' => $billing_description,
            'created_at' => date('c', $model->created_at)
        ];
    }
}