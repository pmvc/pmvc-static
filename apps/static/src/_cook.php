<?php

namespace PMVC\App\static_app;

use PMVC\ActionForm;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\StaticCook';

class StaticCook
{
    public function __invoke(ActionForm $f)
    {
        $type = $f[1];
        $caller = $this->caller;
        switch ($type) {
            case 'css':
                $caller->css($this->_splitPath());
                break;
            case 'js':
                $caller->js($this->_splitPath());
                break;
            default:
                $caller->image($f);
                break;
        }
    }

    private function _splitPath()
    {
        $rawPath = \PMVC\plug('url')->getPath(); 
        $paths = explode('/', $rawPath);
        $paths = array_slice($paths, 3);
        $cookPath = join('/', $paths);
        $files = explode(';', $cookPath); 
        $tmpDir = $this->caller->get_source($files);
        $getFiles = glob($tmpDir.'*');
        return $getFiles;
    }
}
