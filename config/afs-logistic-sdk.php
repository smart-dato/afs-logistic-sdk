<?php

// config for SmartDato/AfsLogistic
return [
    'uri' => env('AFS_LOGISTIC_URI', 'https://shippingnet01.ondot.at'),

    // Defaults to the retrieve endpoint on the host above; set it to use a different full URL.
    'tracking' => env(
        'AFS_LOGISTIC_TRACKING',
        rtrim((string) env('AFS_LOGISTIC_URI', 'https://shippingnet01.ondot.at'), '/').'/afs/dataservice/publicapi/v1/shipment/retrieve',
    ),

    'client_id' => env('AFS_LOGISTIC_CLIENT_ID'),
    'orgunit_id' => env('AFS_LOGISTIC_ORGUNIT_ID'),
    'auth_token' => env('AFS_LOGISTIC_AUTH_TOKEN'),
];
