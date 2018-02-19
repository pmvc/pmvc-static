<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\YUglify';

class YUglify
{
    function __invoke($files)
    {
        $tmpFile = \PMVC\plug('tmp')->file();
        $joinFiles = join(' ', $files);
        if ($this->caller->isDev) {
            $cmdArray = [
                'cat',
                $joinFiles,
                '>',
                $tmpFile
            ];
        } else {
            $nodeJs = \PMVC\realpath(\PMVC\value(\PMVC\getOption('PLUGIN'), ['view', 'react', 'NODEJS']));
            $yuglify = \PMVC\realpath(\PMVC\getOption('yuglify'));
            $cmdArray = [
                $nodeJs,
                $yuglify,
                $joinFiles,
                '-c',
                $tmpFile,
                '>',
                '/dev/null'
            ];
        }
        $cmd = join(' ', $cmdArray);
        $this->_shell($cmd);
        \PMVC\dev(function() use ($cmd) {
            return [$cmd]; 
        }, 'yuglify');
        
        return $tmpFile;
    }

    private function _shell($command)
    {
        $proc = proc_open($command, [ 
            ['pipe','r'],
            ['pipe','w'],
            ['pipe','a']
        ], $pipes);
        $result = null;
        if (is_resource($proc)) {
            fclose($pipes[0]);
            fclose($pipes[1]);
            proc_close($proc);
        }
        return $result;
    }
}
