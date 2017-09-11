<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticJs';

class StaticJs
{
    private $_header = ['Content-type: application/javascript'];
    function __invoke($getFiles)
    {
        if (empty($getFiles)) {
            return false;
        }
        \PMVC\dev(function(){
            $old = $this->_header;
            $this->_header = [];
            return $old;
        }, 'tohtml');
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile.'.min.js';
        if (!filesize($minFile)) {
            return false;
        }
        \PMVC\plug(\PMVC\getOption(_ROUTER))
            ->processHeader( $this->_header );
        return readfile($minFile);
    }
}
