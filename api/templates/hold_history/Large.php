<?php
namespace api\templates\hold_history;

use common\models\Holds_history;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="HoldsHistoryLoadContainerInfoLarge",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="updated_at",
 *         type="data"
 *                 ),
 *      @OA\Property(
 *         property="created_at",
 *         type="data"
 *                 ),
 *       @OA\Property(
 *         property="note_from_customer_and_broker",
 *         type="string"
 *                 ),
 * )
 */
class Large extends BaseTemplate
{

    protected function prepareResult()
    {
        /** @var Holds_history $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->load_id,
            'updated_at' => $model->updated_at,
            'created_at' => $model->created_at,
            'note' => $model->note_from_customer_and_broker,
        ];
    }
}