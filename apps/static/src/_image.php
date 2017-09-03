<?php

namespace PMVC\App\static_app;

use PMVC\ActionForm;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticImage';

class StaticImage
{
    function __invoke(ActionForm $form)
    {
        $imageMiddleware = \PMVC\getOption(
            'imageMiddleware'
        );
        $imageUrl = \PMVC\plug('url')->
            getUrl($imageMiddleware)->
            set($form[1]);
        header('Content-type: image/jpeg');
        $int = readfile($imageUrl);
    }
}
