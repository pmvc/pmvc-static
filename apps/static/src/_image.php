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
        $fileInfo = \PMVC\plug('file_info')->path($relatedPath);
        header('Content-type: '.$fileInfo->getContentType());
        $int = readfile($imageUrl);
    }
}
