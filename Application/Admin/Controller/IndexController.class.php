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
        $data = [];
        for($i = 0; $i < 10; $i++){
            $data[] = [
                'id'    =>  $i,
                'name'  =>  'lisi'.$i,
                'age'   =>  20+$i
            ];
        }

        $this->ajaxReturn([
            'data'  =>  $data,
            'total' => count($data)
        ]);
    }

}