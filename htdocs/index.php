<?php

include_once('../vendor/autoload.php');

\PMVC\Load::plug([
    'controller'=>null
    ,'dispatcher'=>null
    ,'error'=>['all']
    ,'dev'=>null
    ,'debug'=>null
    ,'dotenv'=>[(is_file('../.env.pmvc')? '../.env.pmvc' : '../.env.sample')]
    ,'http'=>null
    ,'get'=>['order'=>'getenv']
]);

$controller = \PMVC\plug('controller');
if($controller->plugApp([], [
    'c'=>'static',
    'd'=>'static'
])){
    $controller->process();
}
