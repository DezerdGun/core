<?php

namespace common\models;

use common\enums\Hold;
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
        $holds->broker_hold = Hold::Fixed;
        $holds->carrier_hold = Hold::Fixed;
        $holds->customer_hold = Hold::Fixed;
        $holds->freight_hold = Hold::Fixed;
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

    public function dates(Load $model)
    {
        $date = new Date();
        $date->load_id = $model->id;
        $date->discharged_date = \common\enums\LoadStatus::EMPTY;
        $date->outgate_date = \common\enums\LoadStatus::EMPTY;
        $date->empty_date = \common\enums\LoadStatus::EMPTY;
        $date->ingate_ate = \common\enums\LoadStatus::EMPTY;
        $date->save();
    }

}
