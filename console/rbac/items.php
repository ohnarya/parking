<?php
return [
    'settingMyAccount' => [
        'type' => 2,
        'description' => 'Setting My Account',
    ],
    'manageParkingLots' => [
        'type' => 2,
        'description' => 'Manage Parking Lots',
    ],
    'manageDestinations' => [
        'type' => 2,
        'description' => 'Manage Destinations',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'settingMyAccount',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'manageParkingLots',
            'manageDestinations',
            'user',
        ],
    ],
];
