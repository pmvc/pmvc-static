<?php

namespace PMVC\App\static_app;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticImage';

class StaticImage
{

    private $_header = [];

    function __invoke($relatedPath)
    {
        $imageMiddleware = \PMVC\plug('get')->
            get('imageMiddlewareUri');
        $imageUrl = \PMVC\plug('url')->
            getUrl($imageMiddleware)->
            set($relatedPath);
        $fileInfo = \PMVC\plug('file_info')->path($relatedPath);
        $this->_header[] = 'Content-type: '.$fileInfo->getContentType();
        \PMVC\dev(function() use ($imageUrl) {
            $old = $this->_header;
            $this->_header = [];
            return [$old, $imageUrl];
        }, 'tohtml');
        if (!empty($this->_header)) {
            \PMVC\plug(\PMVC\getOption(_ROUTER))
                ->processHeader($this->_header);
            return readfile($imageUrl);
        } else {
            return false;
        }
    }
}
