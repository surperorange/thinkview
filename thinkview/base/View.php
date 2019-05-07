<?php

namespace thinkview\base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * 视图基类
 */
class View
{
    protected $variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller, $action)
    {
        $this->_controller = strtolower($controller);
        $this->_action = strtolower($action);
    }

    // 渲染显示
    public function render($variables)
    {
        switch (TPL_ENGINE) {
            case 'twig':
                $viewsPath = APP_PATH . 'app/views/';
                $loader = new FilesystemLoader($viewsPath);
                $twig = new Environment($loader, [
                    'cache' => APP_PATH . 'vendor/twig/compilation_cache',
                    'debug' => true
                ]);

                $defaultHeader = 'header.twig';
                $defaultFooter = 'footer.twig';
                $controllerHeader =  $this->_controller . '/header.twig';
                $controllerFooter =  $this->_controller . '/footer.twig';
                $controllerLayout =  $this->_controller . '/' . $this->_action . '.twig';

                // 页头文件
                if (is_file($viewsPath.$controllerHeader)) {
                    echo $twig->render($controllerHeader,$variables);
                } else {
                    echo $twig->render($defaultHeader,$variables);
                }

                //判断视图文件是否存在
                if (is_file($viewsPath.$controllerLayout)) {
                    echo $twig->render($controllerLayout,$variables);
                } else {
                    echo "<h1>无法找到视图文件</h1>";
                }

                // 页脚文件
                if (is_file($viewsPath.$controllerFooter)) {
                    echo $twig->render($controllerFooter,$variables);
                } else {
                    echo $twig->render($defaultFooter,$variables);
                }
                break;
            default:
                extract($variables);
                $defaultHeader = APP_PATH . 'app/views/header.php';
                $defaultFooter = APP_PATH . 'app/views/footer.php';

                $controllerHeader = APP_PATH . 'app/views/' . $this->_controller . '/header.php';
                $controllerFooter = APP_PATH . 'app/views/' . $this->_controller . '/footer.php';
                $controllerLayout = APP_PATH . 'app/views/' . $this->_controller . '/' . $this->_action . '.php';

                // 页头文件
                if (is_file($controllerHeader)) {
                    include($controllerHeader);
                } else {
                    include($defaultHeader);
                }

                //判断视图文件是否存在
                if (is_file($controllerLayout)) {
                    include($controllerLayout);
                } else {
                    echo "<h1>无法找到视图文件</h1>";
                }

                // 页脚文件
                if (is_file($controllerFooter)) {
                    include($controllerFooter);
                } else {
                    include($defaultFooter);
                }
                break;
        }

    }

}