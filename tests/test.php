<?php

namespace PMVC\App\static_app;

use PMVC\TestCase;

class StaticAppTest extends TestCase
{
    function testApp()
    {
        $test = true;
        $r = \PMVC\l(__DIR__.'/../htdocs/index', 'controller', ['import' => [
          'test'=>true
        ]]);
        $controller = $r->var['controller'];

        if($controller->plugApp()){
            ob_start();
            $controller->process();
            $output = ob_get_contents();
            ob_end_clean();
        }
        $this->haveString('Please specific path.',$output);
    }
}
