<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Guard-Specific Session Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may define session cookie names for each guard.
    | This allows different guards to maintain separate sessions.
    |
    */

    'admin' => [
        'cookie' => 'billing_admin_session',
    ],
    
    'member' => [
        'cookie' => 'billing_member_session',
    ],
    
    'web' => [
        'cookie' => 'billing_session',
    ],
];
