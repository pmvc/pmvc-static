<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticCss';

class StaticCss
{
    function __invoke($getFiles)
    {
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile.'.min.css';
        header("Content-type: text/css");
        readfile($minFile);
    }
}
