<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticCss';

class StaticCss
{
    private $_header = ['Content-type: text/css'];
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
        $minFile = $tmpFile;
        if (!$this->caller->isDev) {
            $minFile .= '.min.css';
        }
        clearstatcache();
        if (!filesize($minFile)) {
            return false;
        }
        \PMVC\plug(\PMVC\getOption(_ROUTER))
            ->processHeader( $this->_header );
        return readfile($minFile);
    }
}
