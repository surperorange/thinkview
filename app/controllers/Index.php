<?php
namespace app\controllers;

use thinkview\base\Controller;

class index extends Controller
{
    // 首页方法，测试框架自定义DB查询
    public function index()
    {
        $this->assign('title', '测试标题');
        $this->assign('keyword', '测试关键字');
        $this->render();
    }
}