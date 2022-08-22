<?php

$routes = [
    'POST oauth2/<action:\w+>' => 'rest/<action>',

    'GET /doc' => '/doc',
    'GET /' => '/',

    'POST /carrier' => 'carrier/create',
    'GET /carrier' => 'carrier/index',
    'GET /carrier/<id:\d+>' => 'carrier/show',
    'POST /carrier/<id:\d+>/sign' => 'carrier/sign',
    'DELETE /carrier/<id:\d+>' => 'carrier/delete',

    'POST /user' => 'user/create',
    'POST /user/resend' => 'user/resend',
    'POST /user/check' => 'user/check',

    'POST /user/recovery' => 'recovery/recovery',
    'POST /user/<confirm_code:\d+>/password' => 'recovery/password',

    'POST /customer' => 'customer/create',

    'GET /lists/state' => 'state/index',
    'GET /lists/load' => 'load/index',
    'GET /lists/container' => 'container/index',
    'GET /lists/truck' => 'truck/index',
    'GET /lists/truck-types' => 'truck-types/index',
    'GET /lists/equipment' => 'equipment/index',
    'GET /lists/load-modes' => 'load-modes/index',
    'GET /lists/stop-types' => 'stop-types/index',

    'POST /company' => 'company/create',

    'POST /load' => 'load/create',
    'GET /load' => 'load/index',
    'GET /load/<id:\d+>' => 'load/show',
    'POST /load/<id:\d+>/sign' => 'load/sign',
    'DELETE /load/<id:\d+>' => 'load/delete',

    'POST /tracking<load_id:>' => 'load-tracking/create',
    'GET /tracking/<load_id:\d+>/list' => 'load-tracking/index',

    'POST /load-stop' => 'load-stop/create',

];

return $routes;
