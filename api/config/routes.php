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
    'DELETE /load/<id:\d+>' => 'load/delete',

    'GET /load/<id:\d+>/documents' => 'load/get-documents',
    'POST /load/<id:>/document' => 'load/create-upload-document',
    'DELETE /load/<load_id:\d+>/document/<id:\d+>' => 'load/delete-document',

    'POST /tracking<load_id:>' => 'load-tracking/create',
    'GET /tracking/<load_id:\d+>/list' => 'load-tracking/index',

    'POST /load-stop' => 'load-stop/create',
    'GET /load-stop' => 'load-stop/index',

    'POST /load<load_id:>/bid' => 'load-bid/create',
    'GET /load/<load_id:\d+>/bid/<id:\d+>' => 'load-bid/get-load-bid',
    'GET /load/<load_id:\d+>/bids' => 'load-bid/get-load-bid-id',
    'DELETE /load/<load_id:\d+>/bid/<id:\d+>' => 'load-bid/load-bid-details-delete',
    'PUT /load/<load_id:\d+>/bid' => 'load-bid/update-load-bid-details',

    'POST /stripe/customer' => 'stripe-customer/create',
    'GET /stripe/customer' => 'stripe-customer/show',
    'POST /stripe/transfer' => 'stripe-transfer/create',
    'GET /stripe/public-key' => 'stripe/public-key'
];

return $routes;
