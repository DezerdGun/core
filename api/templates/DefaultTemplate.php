<?php
namespace api\templates;

use TRS\RestResponse\templates\BaseTemplate;

class DefaultTemplate extends BaseTemplate
{
    protected function prepareResult()
    {
        $model = $this->model;
        $this->result = $model->attributes;
    }
}

