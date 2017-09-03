<?php

namespace PMVC\App\static_app;

use PMVC\ActionForm;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticCss';

class StaticCss
{
    function __invoke(ActionForm $form)
    {
        $files = explode(';', $form[2]); 
        $tmpDir = $this->caller->get_source($files);
        $getFiles = glob($tmpDir.'*');
        $tmpFile = $this->caller->yuglify($getFiles);
        $minFile = $tmpFile.'.min.css';
        header("Content-type: text/css");
        readfile($minFile);
    }
}
