<?php

namespace api\forms\billing;

use common\enums\UserRole;
use common\models\Load;
use common\models\OrdinaryLoad;
use Yii;
use yii\base\Model;

/**
 * Class BillingUpdateForm
 *
 * @OA\Schema(
 *     required={"load_id"}
 * )
 */
class BillingUpdateForm extends  Model
{
    public $user_role;

    public $billing_id = null;
    public function __construct()
    {
        parent::__construct();
        $this->user_role = Yii::$app->user->identity->role;

    }

    /**
     * @OA\Property(
     *      type="boolean"
     * )
     */
    public $is_container;
    /**
     * @OA\Property(
     *      type="integer"
     * )
     */
    public $load_id;
    /**
     * @OA\Property(
     *      type="string"
     * )
     */
    public $note;
    public function rules()
    {
        return [
            ['note', 'string'],
            [['load_id', 'is_container'], 'required'],
            ['is_container', 'boolean'],
            ['load_id', 'integer'],
            ['user_role', 'compare', 'compareValue' => UserRole::CARRIER],
            ['load_id', 'exist', 'targetClass' => Load::className(), 'targetAttribute' => ['load_id' => 'id'], 'when' => function() {
                return $this->is_container;
            }],
            ['load_id', 'exist', 'targetClass' => OrdinaryLoad::className(), 'targetAttribute' => ['load_id' => 'id'], 'when' => function() {
                return !$this->is_container;
            }],
        ];
    }
}
/**
 *  @OA\RequestBody(
 *      request="BillingUpdateForm",
 *      required=true,
 *      @OA\JsonContent(
 *          @OA\Property(
 *              property="BillingUpdateForm",
 *              type="object",
 *              ref="#/components/schemas/BillingUpdateForm"
 *
 *         )
 *     )
 * )
 */