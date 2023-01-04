<?php

namespace api\forms\carrier;

use common\models\Address;
use common\models\Company;
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
class CarrierCreateForm extends Model
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
    use Template;

    public function rules(): array
    {
        return ArrayHelper::merge(
            parent::rules(), [
            [['is_dot', 'company_name', 'user_id', 'business_phone'], 'required'],
            ['mc_number', 'required', 'when' => function ($model) {
                return $model->is_dot === "false";
            }],
            ['dot', 'required', 'when' => function ($model) {
                return $model->is_dot === "true";
            }],
            [['mc_number', 'dot'], 'default', 'value' => null],
            [['mc_number', 'dot', 'is_dot', 'business_phone'], 'string'],
            ['mc_number', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'This MC number has already been taken.'],
            ['dot', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'This DOT has already been taken.'],
            ['company_name', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'This company name has already been taken.'],
            ['user_id', 'exist', 'targetClass' => '\common\models\User', 'message' => 'User ID not found.', 'targetAttribute' => 'id'],
            ['user_id', 'unique', 'targetClass' => '\common\models\Carrier', 'message' => 'Carrier already exists.'],
        ]);
    }

    public function createCompany(Address $address): Company
    {
        $company = new Company();
        $company->address_id = $address->id;
        $company->company_name = $this->company_name;
        $company->mc_number = $this->mc_number;
        $company->dot = $this->dot;
        $company->save();
        return $company;
    }

}
/**
 * @OA\RequestBody(
 *     request="CarrierCreateForm",
 *     required=true,
 *      @OA\MediaType(
 *      mediaType="multipart/form-data",
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="CarrierCreateForm[user_id]",
 *                  type="integer",
 *                  example="1",
 *               ),
 *              @OA\Property(
 *                  property="CarrierCreateForm[mc_number]",
 *                  type="string",
 *                  example="64858",
 *               ),
 *              @OA\Property(
 *                  property="CarrierCreateForm[dot]",
 *                  type="string",
 *                  example="875682",
 *               ),
 *              @OA\Property(
 *                  property="CarrierCreateForm[is_dot]",
 *                  type="boolean",
 *                  default=true
 *               ),
 *              @OA\Property(
 *                  property="CarrierCreateForm[company_name]",
 *                  type="string",
 *                  example="Omega Global",
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
 *                  property="CarrierCreateForm[business_phone]",
 *                  type="string",
 *                  example="+13026893120",
 *               ),
 *              @OA\Property(
 *                  property="Carrier[w9_file]",
 *                  type="string",
 *                  format="binary"
 *              ),
 *              @OA\Property(
 *                  property="Carrier[ic_file]",
 *                  type="string",
 *                  format="binary"
 *              ),
 *          )
 *     )
 * )
 */
