<?php

namespace api\forms\tracking;

use common\models\LoadTracking;
use yii\base\Model;

/**
 * Class LoadTrackingForm
 *
 * @OA\Schema(
 *     required={"load_id"}
 * )
 */

class LoadTrackingForm extends Model
{
    /**
     * @OA\Property(
     *     type="integer"
     * )
     */
    public $load_id;

    /**
     * @OA\Property(
     *     type="number"
     * )
     */
    public $lat;
    /**
     * @OA\Property(
     *     type="number"
     * )
     */
    public $long;

    public function rules()
    {
        return [
            ['load_id','required'],
            ['created','safe'],
            [['lat','long'],'number']
        ];
    }

    public function tracking()
    {
            $track = new LoadTracking();
            $track->load_id = $this->load_id;
            $track->created = date("Y-m-d H:i:s");
            $track->lat = $this->lat;
            $track->long = $this->long;
            $track->save();

    }

}

/**
 *   @OA\RequestBody(
 *     request="LoadTrackingForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="LoadTrackingForm",
 *             type="object",
 *             ref="#/components/schemas/LoadTrackingForm"
 *         )
 *     )
 * )
 */
