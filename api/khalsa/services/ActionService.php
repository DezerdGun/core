<?php

namespace api\khalsa\services;

use api\khalsa\repositories\ActionRepository;

class ActionService
{
    public $actionRepository;

    public function __construct
    (
        ActionRepository $actionRepository
    )
    {
        $this->actionRepository = $actionRepository;
    }
}