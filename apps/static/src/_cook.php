<?php

namespace PMVC\App\static_app;

use PMVC\ActionForm;
use LengthException;

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
        $paths = array_slice(
            explode('/', $rawPath),
            $sliceFrom
        );
        $relatedPath = join('/', $paths);
        if ('/' === substr($relatedPath, -1)) {
            $relatedPath = substr($relatedPath, 0, -1);
        }
        return $relatedPath;
    }

    private function _splitPath($type)
    {
        $cookPath = $this->_getRelatedPath(3);
        $maxCombo = \PMVC\plug('get')->get('staticMaxCombo', 5);
        $files = explode(';', $cookPath); 
        if (count($files) > $maxCombo) {
            throw new LengthException('Combo too many files. ['.$maxCombo.']');
        }
        $tmpDir = $this->caller->get_source(
            $files,
            $type
        );
        if (empty($tmpDir)) {
            return false;
        }
        $getFiles = glob($tmpDir.'*.'.$type);
        return $getFiles;
    }
}
