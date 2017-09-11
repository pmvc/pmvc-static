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
            case 'c':
                return $caller->css($this->_splitPath('css'));
            case 'j':
                return $caller->js($this->_splitPath('js'));
            default:
                return $caller->image($this->_getRelatedPath(2));
        }
    }

    private function _getRelatedPath($sliceFrom)
    {
        $rawPath = \PMVC\plug('url')->getPath(); 
        $paths = explode('/', $rawPath);
        $paths = array_slice($paths, $sliceFrom);
        return join('/', $paths);
    }

    private function _splitPath($type)
    {
        $cookPath = $this->_getRelatedPath(3);
        $files = explode(';', $cookPath); 
        $tmpDir = $this->caller->get_source($files);
        if (empty($tmpDir)) {
            return false;
        }
        $getFiles = glob($tmpDir.'*.'.$type);
        return $getFiles;
    }
}
