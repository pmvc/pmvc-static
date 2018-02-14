<?php

namespace PMVC\App\static_app;

use LengthException;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\GetSource';

class GetSource
{
    function __invoke($files)
    {
        $pGet = \PMVC\plug('get');
        $staticRoot = $pGet->get('staticRoot');
        $maxCombo = $pGet->get('staticMaxCombo', 5);
        $pTmp = \PMVC\plug('tmp');
        $fInfo = \PMVC\plug('file_info');
        $tmpDir = $pTmp->dir();
        $files = array_unique($files);
        if (count($files) > $maxCombo) {
            throw new LengthException('Combo too many files. ['.$maxCombo.']');
        }
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
                return false;
            }
        }
        return $tmpDir;
    }
}
