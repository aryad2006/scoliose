<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'local/vertex_coupons:manage' => [
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => [
            'manager' => CAP_ALLOW,
        ],
    ],
];
