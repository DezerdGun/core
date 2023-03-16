<?php

namespace api\templates\container_bid;
use common\models\ContainerBid;

/**
 * @OA\Schema (
 *      schema="ContainerBidMedium",
 *      @OA\Property (
 *          property="id",
 *          type="integer"
 *      ),
 *      @OA\Property (
 *          property="user_picture",
 *          type="string"
 *      ),
 *      @OA\Property (
 *          property="name",
 *          type="string"
 *      ),
 *      @OA\Property (
 *          property="quantity",
 *          type="integer"
 *      ),
 *      @OA\Property (
 *          property="mobile_number",
 *          type="string"
 *      ),
 *      @OA\Property (
 *          property="email",
 *          type="string"
 *     ),
 *     @OA\Property (
 *          property="note_from_carrier",
 *          type="string"
 *     ),
 *     @OA\Property (
 *          property="created_at",
 *          type="string"
 *     ),
 *     @OA\Property (
 *          property="updated_at",
 *          type="string"
 *     ),
 *     @OA\Property (
 *          property="bid_detail",
 *          type="array",
 *          @OA\Items (
 *              @OA\Property (
 *                  property="charge",
 *                  type="object",
 *                  @OA\Property (
 *                      property="charge_id",
 *                      type="integer"
 *                  ),
 *                  @OA\Property (
 *                      property="charge_name",
 *                      type="string"
 *                  )
 *              ),
 *              @OA\Property (
 *                  property="measure",
 *                  type="object",
 *                  @OA\Property (
 *                      property="measure_id",
 *                      type="integer"
 *                  ),
 *                  @OA\Property (
 *                      property="measure_name",
 *                      type="string"
 *                  )
 *              ),
 *              @OA\Property (
 *                  property="price",
 *                  type="string"
 *              ),
 *              @OA\Property (
 *                  property="free_unit",
 *                  type="integer"
 *              )
 *          )
 *     )
 * )
 */
class Medium extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /* @var ContainerBid $model */
        $model = $this->model;

        $bid_description = [];
        for ($i = 0; $i < count($model->containerBidDetail); $i++) {
            $bid_description[] = [
                'charge' => [
                    'charge_id' => $model->containerBidDetail[$i]->charge_id,
                    'charge_name' => $model->containerBidDetail[$i]->charge->name,
                ],
                'measure' => [
                    'measure_id' => $model->containerBidDetail[$i]->measure_id,
                    'measure_name' => $model->containerBidDetail[$i]->measure->name,
                ],
                'price' => $model->containerBidDetail[$i]->price,
                'free_unit' => $model->containerBidDetail[$i]->free_unit
            ];
        }
        $this->result = [
            'id' => $model->id,
            'user_picture' => $model->user->user_picture,
            'name' => $model->user->name,
            'quantity' => $model->quantity,
            'mobile_number' => $model->user->mobile_number,
            'email' => $model->user->email,
            'note_from_carrier' => $model->note,
            'bid_detail' => $bid_description

        ];
    }
}