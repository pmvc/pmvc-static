<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticCss';

class StaticCss
{
    function __invoke($getFiles)
    {
        if (empty($getFiles)) {
            return false;
        }
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile;
        if (!$this->caller['isDev']) {
            $minFile .= '.min.css';
        }
        clearstatcache();
        if (!filesize($minFile)) {
            return false;
        }
        return \PMVC\plug('file_list')->dump($minFile);
    }
}
