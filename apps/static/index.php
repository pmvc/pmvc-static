<?php
namespace PMVC\App\static_app;

use PMVC;
use PMVC\MappingBuilder;
use PMVC\Action;
use PMVC\ActionForm;

$b = new MappingBuilder();
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticApp';
${_INIT_CONFIG}[_INIT_BUILDER] = $b;

$b->addAction('index', [ 
    _FUNCTION => [ 
        ${_INIT_CONFIG}[_CLASS],
        'index'
    ] 
]);

class StaticApp extends Action
{
    static function index($m, $f){
        $staticRoot = \PMVC\plug('get')->get('staticRoot');
        $app = \PMVC\plug(_RUN_APP);
        $continue = true;
        if (isset($f[0])) {
            switch ($f[0]) {
                case 'd':
                    $app->dev($f); 
                    $continue = false;
                    break;
                case 'c':
                    $app->cdn($f);
                    $continue = false;
                    break;
            }
        }
        if ($continue) {
            $pUrl = \PMVC\plug('url');
            $queryString = \PMVC\plug('getenv')->
                get('QUERY_STRING');
            $url = $pUrl->getUrl($staticRoot);
            $url->set($pUrl->getPath());
            $url->query($queryString); 
            $result = (string)$url;
            $checkPath = $url->getPath();
            if ( 1 >= strlen($checkPath) ||
                $staticRoot === $checkPath
            ) {
                http_response_code(403); 
                echo 'Please specific path.';
                return;
            } else {
                \PMVC\dev(function() use ($result, $staticRoot){
                    \PMVC\plug('cache_header')
                        ->noCache();
                    return [$result, $staticRoot]; 
                }, 'source');
                $fileInfo = \PMVC\plug('file_info')->path($result);
                $header = [
                    'Content-Type: '.$fileInfo->getContentType()
                ];
                \PMVC\dev(function() use (&$header){
                    \PMVC\plug('cache_header')
                        ->noCache();
                    $old = $header;
                    $header = [];
                    return $old;
                }, 'tohtml');
                \PMVC\plug(\PMVC\getOption(_ROUTER))->processHeader(
                    $header
                );
                readfile($result);
            }
        }
    }
}


