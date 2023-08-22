<?php

namespace api\forms;

use common\models\User;
use yii\base\Model;
use yii;

/**
 * Class ConfirmEmailUser
 *
 * @OA\Schema(
 *     required={"confirm_code"}
 * )
 */
class ConfirmEmailUser extends Model
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     */
    public $confirm_code;

    public function rules()
    {
        return [
            // the name, email, subject and body attributes are required
            [['confirm_code'], 'safe']
        ];
    }








}

