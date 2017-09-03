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
                $caller->image($this->_getRelatedPath(2));
                break;
        }
    }

    private function _getRelatedPath($sliceFrom)
    {
        $rawPath = \PMVC\plug('url')->getPath(); 
        $paths = explode('/', $rawPath);
        $paths = array_slice($paths, $sliceFrom);
        return join('/', $paths);
    }

    private function _splitPath()
    {
        $cookPath = $this->_getRelatedPath(3);
        $files = explode(';', $cookPath); 
        $tmpDir = $this->caller->get_source($files);
        $getFiles = glob($tmpDir.'*');
        return $getFiles;
    }
}
