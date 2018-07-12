<?php

/**
 *
 */
class Routes
{
    public $urlRules;

    function __construct($urlRules)
    {
        $this->urlRules = $urlRules;
    }

    //路由
    public function urlDirect($path)
    {
        $urlRules = $this->urlRules;
        //默认跳转页面
        if ($path == '/') {
            $this->urlDirect($urlRules['default']);
        }

        $pathArr = explode('/', $path);
        //判断类是否存在（类名和文件名同）
        if (!class_exists($pathArr[1] . 'Controller')) {
            $this->urlDirect($urlRules['404']);
        }

        $controllerId = $pathArr[1] . 'Controller';
        $actionName = $pathArr[2];
        //初始化控制器实例
        $instance = new $controllerId;
        //函数名
        if (!method_exists($instance, $actionName)) {
            $this->urlDirect($urlRules['404']);
        }
        $instance->$actionName();
        die;
    }


}