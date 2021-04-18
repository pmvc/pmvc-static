<?php

include_once __DIR__.'/../vendor/autoload.php';

$plugins = [
    'controller' => null,
    'dispatcher' => null,
    'error' => ['all'],
    'dev' => null,
    'debug' => null,
    'dotenv' => [is_file(__DIR__.'/../.env.pmvc') ? __DIR__.'/../.env.pmvc' : __DIR__.'/../.env.default'],
    'http' => null,
    'get' => ['order' => ['getenv']],
];

\PMVC\Load::plug($plugins);

$controller = \PMVC\plug('controller');

if (
    !isset($test) &&
    $controller->plugApp(
        [],
        [
            'c' => 'static',
            'd' => 'static',
        ]
    )
) {
    $controller->process();
}
