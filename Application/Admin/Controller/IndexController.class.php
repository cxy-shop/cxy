<?php
namespace Admin\Controller;

use Common\Controller\BaseController;

class IndexController extends BaseController {
    public function index(){
        $userService = new \Admin\Model\UserModel();
        $userList = $userService->select();
        $this->assign('userList', $userList);
        $this->display();
    }

    public function test(){
        $this->display();
    }
    public function test2(){
        $this->display();
    }
}