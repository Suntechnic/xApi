<?php
/*
                                {class}{method}
BX.ajax.runAction('x:api.app.controller.config')
    .then(function(responce) {
        console.log(responce);
    });
*/
namespace X\Api\App;

class Controller extends \App\Api\Controller
{       
    
}

/*
namespace App\Api;
class Controller extends \Bitrix\Main\Engine\Controller
{
    private $actionsConfig = [
            'config' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ]
               ]
        ];

    protected function init()
    {
        parent::init();
        foreach ($this->actionsConfig as $name=>$arConfig) $this->setActionConfig($name, $arConfig);
    }
    
    public function configAction ()
    {
        return \App\Settings::getConfig();
    }
}
*/
