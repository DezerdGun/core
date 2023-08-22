<?php

namespace common\models\search;

use common\models\Company;
use common\models\Customer;

class SearchCustomer extends \yii\base\Model
{
    public $type;
    public $company_name;

    public function rules(): array
    {
        return [
            [['company_name', 'type'], 'string'],
        ];
    }

    public function search(): \yii\db\ActiveQuery
    {
        $query = Customer::find()
        ->from(['customer' => Customer::tableName()])
        ->joinWith([
            'company' => function (\Yii\db\ActiveQuery $query) {
                $query->from(['company' => Company::tableName()]);
            }
        ]);
        if ($this->type) {
            $query->andfilterWhere(['type' => $this->type]);
        }

        if ($this->company_name) {
            $query->andfilterWhere(['ILIKE', 'company.company_name', '%' . $this->company_name . '%', false]);
        }

        $query->orderBy([
            'id' => SORT_DESC
        ]);

        return $query;
    }
}
