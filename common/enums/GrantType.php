<?php

namespace common\enums;

use TRS\Enum\Enum;

class GrantType extends Enum
{
    const CLIENT_CREDENTIALS = 'client_credentials';
    const PASSWORD           = 'password client_credentials';
    const REFRESH_TOKEN      = 'refresh_token';
}