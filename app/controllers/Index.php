<?php
namespace app\controllers;

use thinkview\base\Controller;

class index extends Controller
{
    // 首页方法，测试框架自定义DB查询
    public function index()
    {
    	// 使用默认的模板引擎请用下方方式去渲染模板
        // $this->assign('title', '页面标题');
        // $this->assign('description', '页面描述');
        //$this->render();

        //以下方式为twig模板引擎渲染方式
        $this->data['title'] = "页面标题";
        $this->data['description'] = "页面描述";
        $this->render($this->data);
    }
}