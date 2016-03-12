<?php
namespace Admin\Controller;

use Admin\Util\Menu;
use Common\Controller\BaseController;

class IndexController extends BaseController {
    /**
     * 后台管理主界面
     */
    public function index(){
        $menuUtil = new Menu();
        $this->assign('menuStructure', $menuUtil->generate() );
        $this->display();
    }

    public function getData(){
        $data = [
            [
                'name'  =>  'lisi',
                'age'   =>  21
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  2222
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  22222
            ],
            [
                'name'  =>  'zhangsan',
                'age'   =>  2222
            ]
        ];
        $this->ajaxReturn([
            'data'  =>  $data,
            'total' => count($data)
        ]);
    }

}