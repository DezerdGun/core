<?php

namespace api\models;

/**
 * This is the ActiveQuery class for [[\common\models\Carrier]].
 *
 * @see \common\models\Carrier
 */
class CarrierQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Carrier[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Carrier|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
