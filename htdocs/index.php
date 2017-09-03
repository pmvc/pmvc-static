<?php

include_once('../vendor/autoload.php');

\PMVC\Load::plug([
    'controller'=>null
    ,'dispatcher'=>null
    ,'error'=>['all']
    ,'debug'=>null
    ,'dev'=>null
    ,'dotenv'=>[(is_file('../.env.pmvc')? '../.env.pmvc' : '../.env.sample')]
    ,'http'=>null
]);

$controller = \PMVC\plug('controller');
if($controller->plugApp([], [
    'c'=>'static',
    'd'=>'static'
])){
    $controller->process();
}
