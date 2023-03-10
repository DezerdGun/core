<?php

namespace common\models;

use common\models\traits\Template;
use \common\models\base\Load as BaseLoad;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load".
 */
class Load extends BaseLoad
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

    public function hold($model)
    {
        $holds= new Holds();
        $holds->load_id = $model->id;
        $holds->broker_hold = Holds::Fixed;
        $holds->carrier_hold = Holds::Fixed;
        $holds->customer_hold = Holds::Fixed;
        $holds->freight_hold = Holds::Fixed;
        $holds->save();
    }

    public function chassisLocation(Load $model)
    {
        $chassisLocation = new Chassis_locations();
        $chassisLocation->load_id = $model->id;
        $chassisLocation->chassis_pickup = \common\enums\LoadStatus::EMPTY;
        $chassisLocation->chassis_termination = \common\enums\LoadStatus::EMPTY;
        $chassisLocation->save();
    }

    public function containerReturn(Load $model)
    {
        $container = new Container_return();
        $container->load_id = $model->id;
        $container->container_return = \common\enums\LoadStatus::EMPTY;
        $container->save();
    }
}
