<?php

namespace PMVC\App\static_app;

use PMVC\ActionForm;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticCdn';

class StaticCdn
{
    function __invoke(ActionForm $f)
    {
        $cacheHeader = \PMVC\plug('cache_header');
        $cacheHeader->publicCache(86400*365*10, true);
        $result = $this->caller->cook($f);
        if (false === $result) {
            http_response_code(500);
            $cacheHeader->noCache();
        }
    }
}
