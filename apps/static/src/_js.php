<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticJs';

class StaticJs
{
    function __invoke($getFiles)
    {
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile.'.min.js';
        header("Content-type: application/javascript");
        readfile($minFile);
    }
}
