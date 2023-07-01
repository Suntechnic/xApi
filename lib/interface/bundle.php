<?php
/*
                                {class}{method}
BX.ajax.runAction('x:api.interface.bundle.include')
    .then(function(responce) {
        console.log(responce);
    });
*/
namespace X\Api\Interface;

class Bundle extends \App\Api\Controller
{       
    private $actionsConfig = [
            'include' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                        ]
                ]
        ];

    protected function init()
    {
        foreach ($this->actionsConfig as $name=>$arConfig) $this->setActionConfig($name, $arConfig);
    }
    
    /*
     Файл должен располагать или в /local/templates/ИмяШаблона/includes/ajax или в  /local/includes/ajax
     И иметь название [a-z0-1\,].ajax.php
     [
        'name'*=> ИмяИнклюда
        'template' => ИмяШаблона - если указано, будет подключен файл из /local/templates/ИмяШаблона/includes/ajax, в противном случае из  /local/includes/ajax
     ]
    */
    public function includeAction (array $refParams): array
    {
        $DocumentRoot = \Bitrix\Main\Application::getDocumentRoot();
        $arResponce = [];
        foreach ($refParams as $Key=>$dctParams) {
            if ($dctParams['name']) {
                $Str = '';
                $FileName = str_replace(['/',' ',"\t","\n"],'',$dctParams['name']).'.php';
                $Dir = '/local/';
                if ($dctParams['template']) $Dir.= 'templates/'.str_replace(['/',' ',"\t","\n"],'',$dctParams['template']).'/';
                $Dir.= 'includes/ajax/';

                $FilePath = $DocumentRoot.$Dir.$FileName;
                if (file_exists($FilePath)) {
                    if ($dctParams['params']) {
                        $arParams = $dctParams['params'];
                    }
                    ob_start();
                    include($FilePath);
                    $Str = ob_get_contents();
                    ob_end_clean();
                    if ($arParams) unset($arParams);
                }

                $arResponce[$Key] = $Str;
            }
        }

        if (defined('APPLICATION_ENV') && APPLICATION_ENV == 'dev') {
            $arResponce['debug'] = [
                    '$refParams' => $refParams
                ];
        }

        return $arResponce;
    }
}


