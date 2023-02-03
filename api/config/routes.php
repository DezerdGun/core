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
    'GET /user/<id:\d+>' => 'user/get',
    'GET /user' => 'user/me',

    'POST /user/recovery' => 'user/recovery',
    'POST /user/password' => 'user/password',

    'GET /lists/state' => 'state/index',
    'GET /lists/load' => 'load/index',
    'GET /lists/container' => 'container/index',
    'GET /lists/truck' => 'truck/index',
    'GET /lists/truck-types' => 'truck-types/index',
    'GET /lists/equipment' => 'equipment/index',
    'GET /lists/load-modes' => 'load-modes/index',
    'GET /lists/stop-types' => 'stop-types/index',
    'GET /lists/doc-types' => 'doc-types/index',
    'GET /lists/owner' => 'owner/index',


    'POST /company' => 'company/create',

    'POST /container-load' => 'container-load/create',
    'GET /container-load' => 'container-load/index',
    'GET /container-load/status' => 'container-load/status',
    'GET /container-load/<id:\d+>' => 'container-load/show',
    'DELETE /container-load/<id:\d+>' => 'container-load/delete',

    'GET /load/<id:\d+>/documents' => 'load/get-documents',
    'POST /load/<id:>/document' => 'load/create-upload-document',
    'DELETE /load/<load_id:\d+>/document/<id:\d+>' => 'load/delete-document',

    'POST /tracking/<load_id:>' => 'load-tracking/create',
    'GET /tracking/<load_id:\d+>/list' => 'load-tracking/index',

    'POST /load-stop' => 'load-stop/create',
    'GET /load-stop' => 'load-stop/index',

    'POST /load/<load_id:>/bid' => 'load-bid/create',
    'GET /load/<load_id:\d+>/bid/<id:\d+>' => 'load-bid/get-load-bid',
    'GET /load/<load_id:\d+>/bids' => 'load-bid/get-load-bid-id',
    'DELETE /load/<load_id:\d+>/bid/<id:\d+>' => 'load-bid/load-bid-details-delete',
    'PUT /load/<load_id:\d+>/bid' => 'load-bid/update-load-bid-details',

    'POST /stripe/customer' => 'stripe-customer/create',
    'GET /stripe/customer' => 'stripe-customer/show',
    'POST /stripe/transfer' => 'stripe-transfer/create',
    'GET /stripe/public-key' => 'stripe/public-key',

    'POST /load-container-info' => 'load-container-info/create',
    'POST /load-additional-info' => 'load-additional-info/create',

    'GET /location' => 'location/index',
    'POST /location' => 'location/create',
    'GET /location/<id:\d+>' => 'location/show',
    'GET /location/count' => 'location/count',
    'PATCH /location/<id:\d+>' => 'location/update',
    'DELETE /location/<id:\d+>' => 'location/delete',

    'POST /ordinary-load' => 'ordinary-load/create',
    'POST /ordinary-needed' => 'ordinary-needed/create',

    'POST /customer' => 'customer/create',
    'DELETE /customer/<id:\d+>' => 'customer/delete',
    'GET /customer' => 'customer/index',
    'GET /customer/<id:\d+>' => 'customer/show',
    'PATCH /customer/<id:\d+>' => 'customer/update',
    'GET /customer/count' => 'customer/count',

    'GET /count-broker/count' => 'count-broker/active',
    'GET /invite-broker/active' => 'invite-broker/index',
    'GET /invite-broker/pending' => 'invite-broker/pending',
    'GET /invite-broker/disabled' => 'invite-broker/disabled',
    'GET /invite-broker/<name:>/or/<email:>' => 'invite-broker/show',
    'PATCH /invite-broker/<email:>' => 'invite-broker/restore',
    'POST /invite-broker/<email:>' => 'invite-broker/invite',
    'PATCH /invite-broker/<user_id:\d+>/and/<master_id:\d+>' => 'invite-broker/update',

    'PATCH /profile/<verification_token:>' => 'profile/update',
    'DELETE /profile/<user_id:\d+>/and/<master_id:\d+>' => 'profile/broker-delete',


    ];

return $routes;
