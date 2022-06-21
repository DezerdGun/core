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
    'POST /user/<confirm_code:\d+>/suspect' => 'user/suspect',
    'POST /user/verify' => 'user/verify',
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

];

return $routes;