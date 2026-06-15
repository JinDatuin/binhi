<?php

// sail artisan db:seed --class=RoleSeeder

return [
    'permissions' => [
        'admin' => ['*'],

        'secretary' => [
            'Dashboard' => ['viewPrintable', 'viewWidget'],
            'Member' => ['viewAny', 'view', 'create', 'update'],
            'Achievement' => ['viewAny', 'view', 'create', 'update', 'viewParticipants'],
            'Attendance' => ['viewAny', 'view', 'create', 'update', 'viewAttendees'],
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
