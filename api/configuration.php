<?php

/**
 * High priority use case, not super planned out yet.
 * This will be useful in the future as we do a better job organizing our application configuration.
 * We need to distinguish between configuration and application constants.
 */

return [
    'session' => [
        'prefix' => 'directus6_'
    ],

    'default_language' => 'en',

    'filesystem' => [
        'adapter' => 's3',
        // By default media directory are located at the same level of directus root
        // To make them a level up outsite the root directory
        // use this instead
        // Ex: 'root' => realpath(BASE_PATH.'/../storage/uploads'),
        // Note: BASE_PATH constant doesn't end with trailing slash
        'root' => '/',
        // This is the url where all the media will be pointing to
        // here all assets will be (yourdomain)/storage/uploads
        // same with thumbnails (yourdomain)/storage/uploads/thumbs
        'root_url' => 'http://static.smc.digital',
        'root_thumb_url' => 'http://static.smc.digital/thumbs',
        //S3 config

        'key'    => getenv('S3_KEY'),
        'secret' => getenv('S3_SECRET'),
        'region' => 'eu-west-1',
        'version' => 'latest',
        'bucket' => 'static.smc.digital'
    ],

    'HTTP' => [
        'forceHttps' => true,
        'isHttpsFn' => function () {
            // Override this check for custom arrangements, e.g. SSL-termination @ load balancer
            return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
        }
    ],

    'mail' => [
        'transport' => 'mail',
        'from' => 'chris.sewell@smc.digital'
    ],

    'cors' => [
        'enabled' => true,
        'origin' => '*',
        'headers' => [
            ['Access-Control-Allow-Headers', 'Authorization, Content-Type, Access-Control-Allow-Origin'],
            ['Access-Control-Allow-Credentials', 'false']
        ]
    ],

    'hooks' => [
        'postInsert' => function ($TableGateway, $record, $db) {

        },
        'postUpdate' => function ($TableGateway, $record, $db) {
            $tableName = $TableGateway->getTable();
            switch ($tableName) {
                // ...
            }
        }
    ],

    'feedback' => [
        'token' => '4ceb9d8187ba8b6ba2a2eaf5a7e3a309d3b0c544',
        'login' => true
    ],

    // These tables will not be loaded in the directus schema
    'tableBlacklist' => [],

    'statusMapping' => [
        0 => [
            'name' => 'Delete',
            'color' => '#C1272D',
            'sort' => 3
        ],
        1 => [
            'name' => 'Active',
            'color' => '#5B5B5B',
            'sort' => 1
        ],
        2 => [
            'name' => 'Draft',
            'color' => '#BBBBBB',
            'sort' => 2
        ]
    ]
];
