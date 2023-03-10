<?php

namespace common\enums;

use TRS\Enum\Enum;

class LoadStatus extends Enum
{
    const PENDING = 'pending';
    const IN_PROGRESS = 'in_progress';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';

    const ARCHIVED = 'archived';
    const HIDDEN = 'hidden';
    const ACTIVE = 'active';
    const EMPTY = null;
}