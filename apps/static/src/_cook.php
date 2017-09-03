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
                $caller->css($f);
                break;
            case 'js':
                $caller->js($f);
                break;
            default:
                $caller->image($f);
                break;
        }
    }
}
