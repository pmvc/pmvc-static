<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticJs';

class StaticJs
{
    private $_header = ['Content-type: application/javascript'];
    function __invoke($getFiles)
    {
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile.'.min.js';
        \PMVC\dev(function(){
            $old = $this->_header;
            $this->_header = [];
            return $old;
        }, 'tohtml');
        \PMVC\plug(\PMVC\getOption(_ROUTER))->processHeader(
            $this->_header
        );
        return readfile($minFile);
    }
}
