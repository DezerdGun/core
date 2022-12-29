<?php

namespace api\forms\carrier;

use common\models\Carrier;
use common\models\traits\Template;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class CarrierCreateForm
 *
 * @OA\Schema(
 *     required={"user_id","mc","dot"}
 * )
 */
class CarrierCreateForm extends Model
{
    use Template;
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
    public $mc;
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $dot;

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                [['mc', 'dot'], 'safe'],
                [['user_id'], 'required'],
                ['user_id', 'integer'],
                ['user_id', 'unique', 'targetClass' => '\common\models\Carrier', 'message' => 'Carrier already exists'],
                [['mc', 'dot'] , 'string'],

            ]
        );
    }

    public function create()
    {
        $model = new Carrier();
        $model->user_id = $this->user_id;
        $model->mc = $this->mc;
        $model->dot = $this->dot;
        $model->save();
    }

}
/**
 *   @OA\RequestBody(
 *     request="CarrierCreateForm",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="CarrierCreateForm",
 *             type="object",
 *             ref="#/components/schemas/CarrierCreateForm"
 *         )
 *     )
 *   )
 */
