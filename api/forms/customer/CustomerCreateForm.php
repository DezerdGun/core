<?php

namespace api\forms\customer;

use common\models\Customer;
use yii\base\Model;

/**
 * Class CustomerCreateForm
 *
 * @OA\Schema(
 *     required={"user_id"}
 * )
 */
class CustomerCreateForm extends Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $customer_type;
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
    public $ein;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $street_address;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $city;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $state_code;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $zip;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $contact_name;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $job_title;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $main_phone_number;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $additional_phone_number;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $main_email;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $additional_email;


    public function rules()
    {
        return [
            ['customer_type', 'required'],
            ['customer_type', 'string'],
        ];
    }
}

/**
 * @OA\RequestBody(
 *     request="CustomerCreateForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="CustomerCreateForm",
 *             type="object",
 *             ref="#/components/schemas/CustomerCreateForm"
 *         )
 *     )
 * )
 */
