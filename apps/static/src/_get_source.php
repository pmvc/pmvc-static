<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\GetSource';

class GetSource
{
    function __invoke($files)
    {
        $staticRoot = \PMVC\plug('get')->get('staticRoot');
        $pTmp = \PMVC\plug('tmp');
        $fInfo = \PMVC\plug('file_info');
        $tmpDir = $pTmp->dir();
        $files = array_unique($files);
        foreach ($files as $f) {
            if (empty($f)) {
                continue;
            }
            ob_start();
            $isOK = readfile($staticRoot.$f);
            $content = ob_get_contents();
            ob_end_clean();
            if ($isOK) {
                $new = tempnam($tmpDir, '_').
                    '.'.
                    $fInfo->path($f)->
                    getExt();
                file_put_contents($new, $content);
            } else {
                echo $content;
                trigger_error(json_encode(['Error'=>'Get source file failed.', 'Params'=>[
                    'OK'=>$isOK,
                    'files'=>$files,
                ]]));
                return false;
            }
        }
        return $tmpDir;
    }
}
