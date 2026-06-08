<?php
return [
    'permissions' => [
        'admin' => ['*'],

        'secretary' => [
            'Member' => ['viewAny', 'view', 'create', 'update'],
            'Achievement' => ['viewAny', 'view', 'create', 'update'],
            'Attendance' => ['viewAny', 'view', 'create', 'update'],
            'Widget' => ['viewAny', 'view', 'create', 'update'],
        ],

        'member' => [
            'Member' => ['viewAny', 'view'],
            'Achievement' => ['viewAny', 'view'],
            'Attendance' => ['viewAny', 'view'],
            'Widget' => ['viewAny', 'view'],
        ],
    ],
];