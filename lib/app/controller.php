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
    protected function init()
    {
        parent::init();
        foreach ($this->actionsConfig as $name=>$arConfig) $this->setActionConfig($name, $arConfig);
    }
}

/*
namespace App\Api;
class Controller extends \Bitrix\Main\Engine\Controller
{
    
    private $actionsConfig = [
            //'config' => [
            //        '-prefilters' => [
            //                '\Bitrix\Main\Engine\ActionFilter\Authentication'
            //            ]
            //    ],
        ];
    
    public function configAction ()
    {
        $selfModule = new \X\Module\Module();
        return [
                'assets' => [
                        'images' => '/bitrix/images/'.$selfModule->MODULE_SPACE.'/'.$selfModule->MODULE_UID
                    ],
                'version' => $selfModule->MODULE_VERSION
            ];
    }
}
*/
