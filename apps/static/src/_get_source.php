<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\GetSource';

class GetSource
{
    function __invoke($files)
    {
        $staticRoot = \PMVC\getOption('staticRoot');
        $pTmp = \PMVC\plug('tmp');
        $fInfo = \PMVC\plug('file_info');
        $tmpDir = $pTmp->dir();
        foreach ($files as $f) {
            ob_start();
            $isOk = readfile($staticRoot.$f);
            $content = ob_get_contents();
            ob_end_clean();
            if ($isOk) {
                $new = tempnam($tmpDir, '_').
                    '.'.
                    $fInfo->path($f)->
                    getExt();
                file_put_contents($new, $content);
            } else {
                echo $content;
            }
        }
        return $tmpDir;
    }
}
