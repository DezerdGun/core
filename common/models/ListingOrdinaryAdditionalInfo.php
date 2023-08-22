<?php

namespace common\models;

use Yii;
use \common\models\base\ListingOrdinaryAdditionalInfo as BaseListingOrdinaryAdditionalInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "listing_ordinary_additional_info".
 */
class ListingOrdinaryAdditionalInfo extends BaseListingOrdinaryAdditionalInfo
{
    public $hazmat;
    public $overweight;
    public $reefer;
    public $alcohol;
    public $urgent;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['hazmat_description', 'required', 'when' => function() {
                    if ($this->hazmat == 'yes') {
                        return true;
                    } else {
                        $this->hazmat_description = null;
                        return false;
                    }
                }],
                ['overweight_description', 'required', 'when' => function() {
                    if ($this->overweight == 'yes') {
                        return true;
                    } else {
                        $this->overweight_description = null;
                        return false;
                    }
                }],
                ['reefer_description', 'required', 'when' => function() {
                    if ($this->reefer == 'yes') {
                        return true;
                    } else {
                        $this->reefer_description = null;
                        return false;
                    }
                }],
                ['alcohol_description', 'required', 'when' => function() {
                    if ($this->alcohol == 'yes') {
                        return true;
                    } else {
                        $this->alcohol_description = null;
                        return false;
                    }
                }],
                ['urgent_description', 'required', 'when' => function() {
                    if ($this->urgent == 'yes') {
                        return true;
                    } else {
                        $this->urgent_description = null;
                        return false;
                    }
                }],
                [[
                    'hazmat',
                    'overweight',
                    'reefer',
                    'alcohol',
                    'urgent',
                    'note'
                ], 'string'],
                [['hazmat', 'overweight', 'reefer', 'alcohol', 'urgent'], 'in', 'range' => ['yes', 'no']]
            ]
        );
    }
}
