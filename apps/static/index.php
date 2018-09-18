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
        $app = \PMVC\plug(_RUN_APP, ['isDev'=>false]);
        $continue = true;
        if (isset($f[0])) {
            switch ($f[0]) {
                case 'd':
                    $app['isDev'] = true;
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
            $url = $pUrl->getUrl($staticRoot);
            $url->set($pUrl->getPath());
            $queryString = null;
            if (0===stripos($staticRoot, 'http')) {
                $queryString = \PMVC\plug('getenv')->
                    get('QUERY_STRING');
                $url->query($queryString); 
            }
            $source = (string)$url;
            $checkPath = $url->getPath();
            if ( 1 >= strlen($checkPath) ||
                $staticRoot === $checkPath
            ) {
                http_response_code(403); 
                echo 'Please specific path.';
                return;
            } else {
                \PMVC\dev(function() use ($source, $staticRoot, $pUrl, $queryString){
                    return [
                        'queryString'=> $queryString,
                        'path'       => $pUrl->getPath(),
                        'source'     => $source,
                        'root'       => $staticRoot,
                    ]; 
                }, 'source');
                return \PMVC\plug('file_list')->
                  dump($source, true, false, function(){
                    \PMVC\plug('cache_header')->
                        publicCache(86400*365*10, true);
                  });
            }
        }
    }
}
