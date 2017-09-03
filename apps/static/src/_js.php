<?php

namespace PMVC\App\static_app;

use PMVC\ActionForm;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticJs';

class StaticJs
{
    function __invoke(ActionForm $form)
    {
        $queryString = \PMVC\plug('getenv')->
            get('QUERY_STRING');
        $files = explode(';', $queryString); 
        $tmpDir = $this->caller->get_source($files);
        $getFiles = glob($tmpDir.'*');
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile.'.min.js';
        header("Content-type: application/javascript");
        readfile($minFile);
    }
}
