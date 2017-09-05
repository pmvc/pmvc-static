<?php

namespace PMVC\App\react;

use PHPUnit_Framework_TestCase;

class ReactAppTest extends PHPUnit_Framework_TestCase
{
    /**
     * @runInSeparateProcess
     */
    function testApp()
    {
        \PMVC\initPlugin([
            'controller'=>null
            ,'dispatcher'=>null
            ,'error'=>null
            ,'debug'=>['output'=>'debug_cli']
            ,'dotenv'=>['.env.sample']
            ,'http'=>null
        ]);
        $controller = \PMVC\plug('controller',[
            _RUN_APPS => __DIR__.'/../apps' 
        ]);
        if($controller->plugApp()){
            ob_start();
            $controller->process();
            $output = ob_get_contents();
            ob_end_clean();
        }
        $this->assertContains('Please specific path.',$output);
    }
}
