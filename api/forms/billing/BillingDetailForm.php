<?php

namespace api\forms\billing;

use common\enums\UserRole;
use common\models\Billing;
use common\models\Charge;
use common\models\Measure;
use yii\base\Model;
use Yii;
/**
 * Class BillingDetailForm
 *
 * @OA\Schema(
 *     required={"charge_id", "price", "unit_count", "measure_id", "per_unit"}
 * )
 */
class BillingDetailForm extends Model
{
    const MAX_PRICE = 999999.99;
    public $user_role;
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->user_role = Yii::$app->user->identity->role;
    }

    public $billing_id;

    /**
     *  @OA\Property(
     *      property="charge_id",
     *      type="array",
     *      @OA\Items(
     *          type="integer"
     *   )
     *  )
     */

    public $charge_id;
    /**
     *  @OA\Property(
     *      property="description",
     *      type="array",
     *      @OA\Items(
     *          type="string"
     *   )
     *  )
     */
    public $description;
    /**
     *  @OA\Property(
     *      property="price",
     *      type="array",
     *      @OA\Items(
     *          type="number",
     *          format="float"
     *      )
     *  )
     */
    public $price;
    /**
     *  @OA\Property(
     *      property="unit_count",
     *      type="array",
     *      @OA\Items(
     *          type="integer"
     *   )
     *  )
     */
    public $unit_count;
    /**
     *  @OA\Property(
     *      property="measure_id",
     *      type="array",
     *      @OA\Items(
     *          type="integer"
     *   )
     *  )
     */
    public $measure_id;
    /**
     *  @OA\Property(
     *      property="free_unit",
     *      type="array",
     *      @OA\Items(
     *          type="integer"
     *   )
     *  )
     */
    public $free_unit;
    /**
     *  @OA\Property(
     *      property="per_unit",
     *      type="array",
     *      @OA\Items(
     *          type="integer"
     *   )
     *  )
     */
    public $per_unit;

    public function rules(): array
    {
        return [
            [['charge_id', 'unit_count', 'measure_id', 'per_unit'], 'each', 'rule' => ['required'] ],
            ['charge_id', 'each', 'rule' => ['exist', 'targetClass' => Charge::className(), 'targetAttribute' => ['charge_id' => 'id']]],
            ['measure_id', 'each', 'rule' => ['exist', 'targetClass' => Measure::className(), 'targetAttribute' => ['measure_id' => 'id']]],
            [['price'], 'each', 'rule' => ['match', 'pattern' => '/^\d{0,8}(\.\d{1,2}?)?$/']],
            [['price'], 'each', 'rule' => ['number', 'max' => self::MAX_PRICE]],
            [['free_unit'], 'each', 'rule' => ['integer']],
            ['user_role', 'compare', 'compareValue' => UserRole::CARRIER],
            ['billing_id', 'integer'],
            ['billing_id', 'exist', 'targetClass' => Billing::className(), 'targetAttribute' => ['billing_id' => 'id']],
            ['description', 'each', 'rule' => ['string']]
        ];
    }
}
/**
 *  @OA\RequestBody(
 *      request="BillingDetailForm",
 *      required=true,
 *      @OA\JsonContent(
 *          @OA\Property(
 *              property="BillingDetailForm",
 *              type="object",
 *              ref="#/components/schemas/BillingDetailForm"
 *
 *         )
 *     )
 * )
 */