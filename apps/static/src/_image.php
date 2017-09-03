<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticImage';

class StaticImage
{
    function __invoke($relatedPath)
    {
        $imageMiddleware = \PMVC\getOption(
            'imageMiddleware'
        );
        $imageUrl = \PMVC\plug('url')->
            getUrl($imageMiddleware)->
            set($relatedPath);
        header('Content-type: image/jpeg');
        $int = readfile($imageUrl);
    }
}
