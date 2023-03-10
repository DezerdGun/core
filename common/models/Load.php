<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\Load as BaseLoad;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load".
 */
class Load extends BaseLoad
{
    use Template;

    const PENDING = 'pending';
    const IN_PROGRESS = 'in_progress';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';
    const EMPTY = null;
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
        $chassisLocation->chassis_pickup = Load::EMPTY;
        $chassisLocation->chassis_termination = Load::EMPTY;
        $chassisLocation->save();
    }

    public function containerReturn(Load $model)
    {
        $container = new Container_return();
        $container->load_id = $model->id;
        $container->container_return = Load::EMPTY;
        $container->save();
    }
}
