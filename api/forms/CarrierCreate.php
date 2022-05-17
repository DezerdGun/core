<?php

namespace api\forms;

use yii\base\Model;

/**
 * Class CarrierCreate
 *
 * @OA\Schema(
 *     required={"user_id","mc","dot","ein","w9","ic"}
 * )
 */
class CarrierCreate extends Model
{
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

    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $ein;

    /**
     * @OA\Property(
     *     type="file"
     * )
     */
    public $w9;

    /**
     * @OA\Property(
     *     type="string",
     * )
     */
    public $ic;

    public function rules()
    {
        return [
            [['user_id','mc', 'dot', 'ein', 'ic'], 'required'],
            [['w9'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->w9->saveAs('/' . $this->w9->baseName . '.' . $this->w9->extension);
            return true;
        } else {
            return false;
        }
    }

}

/**
 * @OA\RequestBody(
 *     request="CarrierCreate",
 *     required=true,
 *     @OA\JsonContent(
 *         @OA\Property(
 *             property="CarrierCreate",
 *             type="object",
 *             ref="#/components/schemas/CarrierCreate"
 *         )
 *     )
 * )
 */