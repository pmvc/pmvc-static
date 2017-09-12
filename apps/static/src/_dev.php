<?php

namespace PMVC\App\static_app;

use PMVC\ActionForm;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticDev';

class StaticDev
{
    function __invoke(ActionForm $f)
    {
        \PMVC\plug('cache_header')->
            noCache();
        $this->caller->cook($f);
    }
}
