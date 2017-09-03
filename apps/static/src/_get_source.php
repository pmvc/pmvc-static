<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\GetSource';

class GetSource
{
    function __invoke($files)
    {
        $staticRoot = \PMVC\getOption('staticRoot');
        $tmpDir = \PMVC\plug('tmp')->dir();
        foreach ($files as $f) {
            ob_start();
            $isOk = readfile($staticRoot.$f);
            $content = ob_get_contents();
            ob_end_clean();
            if ($isOk) {
                file_put_contents($tmpDir.$f, $content);
            } else {
                echo $content;
            }
        }
        return $tmpDir;
    }
}
