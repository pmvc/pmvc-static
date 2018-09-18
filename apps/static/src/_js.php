<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticJs';

class StaticJs
{
    function __invoke($getFiles)
    {
        if (empty($getFiles)) {
            return false;
        }
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile;
        if (!$this->caller['isDev']) {
            $minFile .= '.min.js';
        }
        clearstatcache();
        if (!filesize($minFile)) {
            return false;
        }
        return \PMVC\plug('file_list')->dump($minFile);
    }
}
