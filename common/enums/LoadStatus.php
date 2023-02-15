<?php

namespace common\enums;

use TRS\Enum\Enum;

class LoadStatus extends Enum
{
    const PENDING = 'Pending';
    const IN_PROGRESS = 'in_Progress';
    const COMPLETED = 'Completed';
    const CANCELLED = 'Cancelled';

    const ARCHIVED = 'archived';
    const HIDDEN = 'hidden';
    const ACTIVE = 'active';
}