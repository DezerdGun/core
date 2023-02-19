<?php

namespace common\enums;

class UserRole extends \TRS\Enum\Enum
{
    const CARRIER = 'Carrier';
    const SUB_BROKER = 'Sub broker';
    const MASTER_BROKER = 'Master broker';
    const OWNER = 'Owner';
}
