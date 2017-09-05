<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticCss';

class StaticCss
{
    private $_header = ['Content-type: text/css'];
    function __invoke($getFiles)
    {
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile.'.min.css';
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
