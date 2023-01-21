<?php

namespace api\forms\company;

use common\models\traits\Template;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class CarrierCreateForm
 *
 * @OA\Schema(
 *     required={}
 * )
 */
class CompanyCreateForm extends Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $mc_number;
    /**
     * @OA\Property(
     *     type="integer"
     * )
     */
    public $user_id;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $dot;
    /**
     * @OA\Property(
     *     type="boolean",
     *     default=false
     * )
     */
    public $is_dot;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $company_name;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $business_phone;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $ein;
    use Template;

    const SCENARIO_CARRIER_CREATE = 'carrier_create';

    public function rules(): array
    {
        return ArrayHelper::merge(
            parent::rules(), [
            ['company_name', 'required'],
            [['is_dot', 'user_id', 'business_phone'], 'required', 'on' => self::SCENARIO_CARRIER_CREATE],
            ['mc_number', 'required', 'when' => function ($model) {
                return $model->is_dot === "false";
            }, 'on' => 'carrier_create'],
            ['dot', 'required', 'when' => function ($model) {
                return $model->is_dot === "true";
            }, 'on' => 'carrier_create'],
            [['mc_number', 'dot', 'ein'], 'default', 'value' => null],
            [['mc_number', 'dot', 'is_dot', 'business_phone'], 'string'],
            ['user_id', 'exist', 'targetClass' => '\common\models\User', 'message' => 'User ID not found.', 'targetAttribute' => 'id'],
            ['user_id', 'unique', 'targetClass' => '\common\models\Carrier', 'message' => 'Carrier already exists.'],
        ]);
    }

}
