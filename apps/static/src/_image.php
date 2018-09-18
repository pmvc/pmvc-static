<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticImage';

class StaticImage
{
    function __invoke($relatedPath)
    {
        $imageMiddleware = \PMVC\plug('get')->
            get('imageMiddlewareUri');
        $imageUrl = \PMVC\plug('url')->
            getUrl($imageMiddleware)->
            set($relatedPath);
        \PMVC\dev(function() use (
            $imageUrl,
            $imageMiddleware,
            $relatedPath
        ){
            return [
                'finial'=>(string)$imageUrl,
                'middlewareHost'=>$imageMiddleware,
                'path'=>$relatedPath
            ];
        }, 'source');
        return \PMVC\plug('file_list')->
          dump((string)$imageUrl, true, false);
    }
}
