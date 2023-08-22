<?php

namespace common\models;

use common\enums\Hold;
use common\enums\LoadStatus;
use common\models\traits\Template;
use \common\models\base\OrdinaryLoad as BaseOrdinaryLoad;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ordinary_load".
 */
class   OrdinaryLoad extends BaseOrdinaryLoad
{
    use Template;
    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules(): array
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public function load_reference_number($model)
    {
        $models = new LoadOrdinaryReferenceNumber();
        $models->load_id = $model->id;
        $models->seal = LoadStatus::EMPTY;
        $models->pick_up = LoadStatus::EMPTY;
        $models->appointment = LoadStatus::EMPTY;
        $models->reservation = LoadStatus::EMPTY;
        $models->save();
    }

    public function hold(OrdinaryLoad $model)
    {
        $holds= new OrdinaryHolds();
        $holds->load_id = $model->id;
        $holds->broker_hold = Hold::Fixed;
        $holds->carrier_hold = Hold::Fixed;
        $holds->customer_hold = Hold::Fixed;
        $holds->freight_hold = Hold::Fixed;
        $holds->save();
    }
}
