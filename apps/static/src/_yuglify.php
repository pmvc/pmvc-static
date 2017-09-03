<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\YUglify';

class YUglify
{
    function __invoke($files)
    {
        $tmpFile = \PMVC\plug('tmp')->file();
        $nodeJs = \PMVC\getOption('nodeJs');
        $yuglify = \PMVC\getOption('yuglify');
        $cmd = join(' ', [
            $nodeJs,
            $yuglify,
            join(' ', $files),
            '-c',
            $tmpFile
        ]);
        $run = shell_exec($cmd);
        return $tmpFile;
    }
}
