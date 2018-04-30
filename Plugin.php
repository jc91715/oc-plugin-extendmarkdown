<?php namespace Jc91715\ExtendMarkDown;

use Backend;
use System\Classes\PluginBase;
use RainLab\Blog\Controllers\Posts as PostController;
use RainLab\Blog\FormWidgets\BlogMarkdown;
/**
 * ExtendMarkDown Plugin Information File
 */
class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'ExtendMarkDown',
            'description' => 'If your clipboard has a picture, only CTRL + V for Windows or Command + V for Mac',
            'author'      => 'jc91715',
            'icon'        => 'icon-leaf'
        ];
    }

    public function register()
    {

    }

    public function boot()
    {
//        \Event::listen('backend.page.beforeDisplay', function($controller, $action, $params) {
//
//            if($controller instanceof PostController){
//                if(in_array($action,['create','update'])){
//                    $controller->addJs('/plugins/jc91715/extendmarkdown/assets/js/paste.js');
//                    $controller->addJs('/plugins/jc91715/extendmarkdown/assets/js/img_upload.js');
//                    $controller->addJs('/plugins/jc91715/extendmarkdown/assets/js/init.js');
//                }
//            }
//
//        });

        BlogMarkdown::extend(function($widget){
                $widget->addJs('/plugins/jc91715/extendmarkdown/assets/js/paste.js');
                $widget->addJs('/plugins/jc91715/extendmarkdown/assets/js/img_upload.js');
                $widget->addJs('/plugins/jc91715/extendmarkdown/assets/js/init.js');
        });


    }


}
