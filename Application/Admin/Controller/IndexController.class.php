<?php
namespace Admin\Controller;

use Admin\Util\Menu;

class IndexController extends BaseController
{
    /**
     * 后台管理主界面
     */
    public function index()
    {
        $menuUtil = new Menu();
        $this->assign('menuStructure', $menuUtil->generate());
        $this->display();
    }

}