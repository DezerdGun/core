<?php

$routes = [
    'POST oauth2/<action:\w+>' => 'rest/<action>',

    'GET /doc' => '/doc',
    'GET /' => '/',
    'POST /carrier' => 'carrier/create',
    'POST /carrier/company' => 'carrier/create-company',
    'GET /carrier/my-account' => 'carrier/show',
    'PATCH /carrier/my-account' => 'carrier/update',
    'PATCH /carrier/document/w9' => 'carrier-document/update-w9',
    'PATCH /carrier/document/ic' => 'carrier-document/update-ic',
    'GET /carrier/document' => 'carrier-document/view',

    'POST /user/resend' => 'user/resend',
    'POST /user/check' => 'user/check',
    'GET /user/<id:\d+>' => 'user/get',
    'GET /user' => 'user/me',
    'PATCH /user/photo' => 'user/upload-photo',
    'DELETE /user/photo' => 'user/delete-photo',
    'PATCH /user/password/change' => 'user/change-password',

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
    'GET /lists/charge' => 'charge/index',
    'GET /lists/measure' => 'measure/index',

    'POST /load-container-return' => 'load-container-return/create',
    'PATCH /load-container-return/<id:\d+>' => 'load-container-return/update',
    'DELETE /load-container-return/<id:\d+>' => 'load-container-return/delete',
    'GET /load-container-return/<id:\d+>' => 'load-container-return/show',

    'POST /load-chassis-locations' => 'load-chassis-locations/create',
    'PATCH /load-chassis-locations/<id:\d+>' => 'load-chassis-locations/update',
    'DELETE /load-chassis-locations/<id:\d+>' => 'load-chassis-locations/delete',
    'GET /load-chassis-locations/<id:\d+>' => 'load-chassis-locations/show',

    'PATCH /load-dates/<id:\d+>' => 'load-dates/update',
    'DELETE /load-dates/<id:\d+>' => 'load-dates/delete',
    'GET /load-dates' => 'load-dates/index',
    'GET /load-dates/<id:\d+>' => 'load-dates/show',

    'POST /company' => 'company/create',

    'POST /container-load' => 'container-load/create',
    'GET /container-load' => 'container-load/index',
    'GET /container-load/status' => 'container-load/status',
    'GET /container-load/<id:\d+>' => 'container-load/show',
    'DELETE /container-load/<id:\d+>' => 'container-load/delete',
    'POST /load-container-info' => 'load-container-info/create',
    'GET /container-load/count' => 'container-load/active',
    'PATCH /container-load/status/<id:\d+>' => 'container-load/reassign',
    'POST /load-additional-info' => 'load-additional-info/create',
    'PATCH /load-reference-number/<id:\d+>' => 'load-reference-number/update',
    'POST /load-reference-number' => 'load-reference-number/create',
    'PATCH /load-container-info/<id:\d+>' => 'load-container-info/update',
    'DELETE /load-reference-number/<id:\d+>' => 'load-reference-number/delete',
    'GET /load-reference-number/<id:\d+>' => 'load-reference-number/show',

    'POST /holds-load-container-info' => 'holds-load-container-info/create',
    'PATCH /holds-load-container-info/<load_id:\d+>' => 'holds-load-container-info/update',
    'GET /holds-load-container-info/<id:\d+>' => 'holds-load-container-info/show',
    'GET /holds-load-container-info' => 'holds-load-container-info/index',


    'PATCH /load-document/<id:\d+>' => 'load-document/update',
    'GET /load-document/<id:\d+>' => 'load-document/get-documents',
    'POST /load-document' => 'load-document/create-upload-document',
    'DELETE /load-document/<id:\d+>' => 'load-document/delete-document',

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

    'GET /location' => 'location/index',
    'POST /location' => 'location/create',
    'GET /location/<id:\d+>' => 'location/show',
    'GET /location/count' => 'location/count',
    'PATCH /location/<id:\d+>' => 'location/update',
    'DELETE /location/<id:\d+>' => 'location/delete',

    'POST /ordinary-load' => 'ordinary-load/create',
    'POST /ordinary-needed' => 'ordinary-needed/create',
    'GET /ordinary-load' => 'ordinary-load/index',
    'GET /ordinary-load/count' => 'ordinary-load/active',
    'GET /ordinary-load/<id:\d+>' => 'ordinary-load/show',
    'POST /load-ordinary-additional-info' => 'load-ordinary-additional-info/create',
    'POST /load-ordinary-description' => 'load-ordinary-description/create',
    'POST /ordinary-load-reference-number' => 'ordinary-load-reference-number/create',
    'PATCH /ordinary-load-reference-number/<id:\d+>' => 'ordinary-load-reference-number/update',
    'DELETE /ordinary-load-reference-number/<id:\d+>' => 'ordinary-load-reference-number/delete',
    'PATCH /ordinary-load/status/<id:\d+>' => 'ordinary-load/reassign',
    'DELETE /ordinary-load/<id:\d+>' => 'ordinary-load/delete',

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
    'GET /invite-broker/' => 'invite-broker/show',
    'PATCH /invite-broker/<id:\d+>' => 'invite-broker/restore',
    'POST /invite-broker' => 'invite-broker/invite',
    'PUT /invite-broker/<user_id:\d+>' => 'invite-broker/update',
    'GET /invite-broker/<verification_token:>' => 'invite-broker/inviter',

    'PATCH /profile/<verification_token:>' => 'profile/update',
    'DELETE /profile/<user_id:\d+>' => 'profile/broker-delete',

    'POST /listing/container/additional-info' => '/listing-container/additional-info',
    'POST /listing/container' => '/listing-container/create',
    'POST /listing/container-info' => '/listing-container/container-info',
    'GET /listing/container' => '/listing-container/index',
    'PATCH /listing/container/reassign/<id:\d+>'  => '/listing-container/reassign',
    'GET /listing/container/count' => '/listing-container/count',
    'PATCH /listing/container/status' => '/listing-container/update-status',

    'POST /listing/ordinary' => 'listing-ordinary/create',
    'POST /listing/ordinary-info' => 'listing-ordinary/ordinary-info',
    'POST /listing/ordinary/additional-info' => 'listing-ordinary/additional-info',
    'GET /listing/ordinary' => 'listing-ordinary/index',
    'PATCH /listing/ordinary/status' => '/listing-ordinary/update-status',
    'GET /listing/ordinary/count' => '/listing-ordinary/count',
    'PATCH /listing/ordinary/reassign/<id:\d+>' => '/listing-ordinary/reassign',

    'GET /broker/my-account' => '/broker/show',
    'PATCH /broker/my-account' => '/broker/update',

    'POST /container/bid' => 'container-bid/create',
    'GET /container/bid' => 'container-bid/index',
    'PATCH /container/bid/favorite/<id:\d+>' => 'container-bid/favorite',
    'DELETE /container/bid/<id:\d+>' => 'container-bid/delete',
    'PATCH /container/bid/<id:\d+>' => 'container-bid/update',

    'POST /container/bid/log/<id:\d+>' => 'container-bid-log/create',
    'GET /container/bid/log/<id:\d+>' => 'container-bid-log/index',

    'POST /container/bid/detail' =>'container-bid-detail/create',
    'PATCH /container/bid/detail/<id:>' => 'container-bid-detail/update',
    'DELETE /container/bid/detail/<id:>' => 'container-bid-detail/delete'

    ];

return $routes;
