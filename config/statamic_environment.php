<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Environment Name Mappings
    |--------------------------------------------------------------------------
    |
    | Configure which environment names should be treated as different environment types.
    | You can define completely custom environment type names and map multiple APP_ENV
    | values to each type. The keys become your environment type names.
    |
    | Examples:
    | - Standard: 'local', 'staging', 'production'
    | - Custom: 'development', 'testing', 'live'
    | - Enterprise: 'dev', 'qa', 'uat', 'prod'
    |
    */

    'environments' => [
        'local' => ['local'],
        'staging' => ['staging', 'dev'],
        'production' => ['production', 'prod', 'live'],

        // Example custom environment types:
        // 'development' => ['local', 'dev'],
        // 'testing' => ['test', 'staging', 'qa'],
        // 'live' => ['production', 'prod'],
        // 'qa' => ['qa', 'quality'],
        // 'uat' => ['uat', 'acceptance'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Labels
    |--------------------------------------------------------------------------
    |
    | Configure the display labels for each environment type defined above.
    | These labels are used in both the widget and header badges.
    |
    */

    'labels' => [
        'local' => 'Local',
        'staging' => 'Staging',
        'production' => 'Live',

        // Match your custom environment types:
        // 'development' => 'Dev',
        // 'testing' => 'Test',
        // 'qa' => 'QA',
        // 'uat' => 'UAT',
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Icons
    |--------------------------------------------------------------------------
    |
    | Configure the emoji icons for each environment type.
    |
    */

    'icons' => [
        'local' => '👨‍💻',
        'staging' => '🔥',
        'production' => '🚀',
        'undefined' => '🚨',

        // Match your custom environment types:
        // 'development' => '🛠️',
        // 'testing' => '🧪',
        // 'qa' => '🔍',
        // 'uat' => '✅',
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Badge Colors
    |--------------------------------------------------------------------------
    |
    | Configure the colors for environment badges in the header.
    |
    */

    'colors' => [
        'local' => [
            'background' => 'rgb(39, 145, 16)',
            'color' => 'white',
        ],
        'staging' => [
            'background' => 'rgb(153, 0, 0)',
            'color' => 'white',
        ],
        'production' => [
            'background' => 'rgb(43, 45, 48)',
            'color' => 'white',
            'border' => '1px solid white',
        ],

        // Match your custom environment types:
        // 'development' => [
        //     'background' => 'rgb(0, 123, 255)',
        //     'color' => 'white',
        // ],
        // 'testing' => [
        //     'background' => 'rgb(255, 193, 7)',
        //     'color' => 'black',
        // ],
        // 'qa' => [
        //     'background' => 'rgb(108, 117, 125)',
        //     'color' => 'white',
        // ],
        // 'uat' => [
        //     'background' => 'rgb(40, 167, 69)',
        //     'color' => 'white',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Widget Display Options
    |--------------------------------------------------------------------------
    |
    | Configure when additional environment information is displayed in the widget.
    | You can specify which environment types should show the detailed information table.
    |
    */

    'widget' => [
        'show_details' => ['local', 'staging'], // Environment types that show additional info
        'always_show_details' => false,         // Set to true to always show details regardless of environment
        'never_show_details' => false,          // Set to true to never show details regardless of environment
    ],

    /*
    |--------------------------------------------------------------------------
    | Background Patterns
    |--------------------------------------------------------------------------
    |
    | Configure header background patterns for each environment type.
    | Supports different pattern types: 'stripes', 'dots', 'checkerboard', 'solid'
    |
    */

    'patterns' => [
        'local' => [
            'type' => 'stripes',
            'angle' => -55,
            'light_mode' => [
                'primary' => '#ffffff',
                'secondary' => 'rgba(211, 255, 201, 0.8)',
            ],
            'dark_mode' => [
                'primary' => '#1a1a1a',
                'secondary' => 'rgba(41, 82, 32, 0.8)',
            ],
        ],
        'staging' => [
            'type' => 'stripes',
            'angle' => -55,
            'light_mode' => [
                'primary' => '#ffffff',
                'secondary' => 'rgba(255, 201, 201, 0.8)',
            ],
            'dark_mode' => [
                'primary' => '#1a1a1a',
                'secondary' => 'rgba(82, 32, 32, 0.8)',
            ],
        ],
        'production' => [
            'type' => 'solid',
            'light_mode' => [
                'primary' => '#ffffff',
            ],
            'dark_mode' => [
                'primary' => '#1a1a1a',
            ],
        ],

        // Example of different pattern types:
        // 'custom_env' => [
        //     'type' => 'dots',
        //     'size' => '4px',
        //     'spacing' => '20px',
        //     'light_mode' => [
        //         'primary' => '#ffffff',
        //         'secondary' => '#ff6b6b',
        //     ],
        //     'dark_mode' => [
        //         'primary' => '#1a1a1a',
        //         'secondary' => '#ff4757',
        //     ],
        // ],
        // 'qa_env' => [
        //     'type' => 'checkerboard',
        //     'size' => 20,  // Size of checkerboard squares in pixels
        //     'light_mode' => [
        //         'primary' => '#ffffff',
        //         'secondary' => '#ffd93d',
        //     ],
        //     'dark_mode' => [
        //         'primary' => '#1a1a1a',
        //         'secondary' => '#ffab00',
        //     ],
        // ],
    ],
];
