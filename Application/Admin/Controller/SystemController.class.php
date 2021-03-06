<?php
namespace Admin\Controller;

use Admin\Model\UserModel;

class SystemController extends BaseController
{
    /**
     * 登录页面
     */
    public function login()
    {
        $this->display();
    }

    /**
     * 登录验证
     */
    public function loginValidate()
    {
        $username = I('username');
        $password = I('password');

        $res = UserModel::validatePassoword($username, $password);
        if ($res) {
            UserModel::registerUser();
            $this->ajaxSuccess('登录成功', ['url' => self::$homePage]);
        } else {
            $this->ajaxFail('登录失败,请检查用户名和密码');
        }
    }

    /**
     * 注销登录操作
     */
    public function logoutHandle()
    {
        UserModel::destroyUser();
        $this->ajaxSuccess('退出成功', ['url' => self::$loginPage]);
    }
}