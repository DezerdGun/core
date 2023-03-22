<?php

namespace common\models;

use common\helpers\DateTime;
use common\models\traits\Template;
use Yii;
use \common\models\base\Holds as BaseHolds;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "holds".
 */
class Holds extends BaseHolds
{
    use Template;
    public function behaviors(): array
    {
        return DateTime::setLocalTimestamp(parent::behaviors());
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
    public $role;
    public $_old_load_id;
    public $_old_freight_hold;
    public $_old_customer_hold;
    public $_old_carrier_hold;
    public $_old_broker_hold;

    public function afterFind(): bool
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        $this->_old_load_id = $this->load_id;
        $this->_old_freight_hold = $this->freight_hold;
        $this->_old_customer_hold = $this->customer_hold;
        $this->_old_carrier_hold = $this->carrier_hold;
        $this->_old_broker_hold = $this->broker_hold;
        return true;
    }

    public function addNoteHistory($str)
    {
        $note = new Holds_history();
        $nowDate = DateTime::nowDateYMD();
        $nowTime = DateTime::nowTime();
        $note->updated_at = "{$nowDate} {$nowTime}";
        $note->load_id = $this->load_id;
        $note->note_from_customer_and_broker = $str;
        $note->save();
    }

    public function changeWriterHolds($model,$name)
    {

        $temporary = $model;
        if ($model) {
            $temporary = " $name : Changed:";
            if ($model->_old_broker_hold != $model->broker_hold) {
                $temporary = $temporary . sprintf(
                        'Broker_Hold update from  %s to %s.',
                        $model->_old_broker_hold,
                        $model->broker_hold
                    );

            }
            if ($model->_old_carrier_hold != $model->carrier_hold) {
                $temporary = $temporary . sprintf(
                        'Carrier_Hold update from %s to %s.',
                        $model->_old_carrier_hold,
                        $model->carrier_hold
                    );
            }
            if ($model->_old_customer_hold != $model->customer_hold) {
                $temporary = $temporary . sprintf(
                        'Custom_Hold update from  %s to %s.',
                        $model->_old_customer_hold,
                        $model->customer_hold
                    );
            }
            if ($model->_old_freight_hold != $model->freight_hold) {
                $temporary = $temporary . sprintf(
                        ' Freight_Hold update from  %s to %s.',
                        $model->_old_freight_hold,
                        $model->freight_hold
                    );
            }
        }
        return $model->addNoteHistory($temporary);

    }


}
