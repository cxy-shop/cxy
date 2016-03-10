<?php
namespace Common\Controller;

use Admin\Model\UserModel;
use Think\Controller;

class BaseController extends Controller
{
    public static $homePage = '/admin/index/index';
    public static $loginPage = '/admin/system/login';
    //不需要登录验证的URL
    public static $ignoreUrl = [
        'admin/system/login',
        'admin/system/loginvalidate'
    ];

    public static function isIgnoreUrl($url)
    {
        return in_array(strtolower($url), self::$ignoreUrl);
    }

    /**
     *
     */
    protected function _initialize()
    {
        $userService = new UserModel();
        if (!self::isIgnoreUrl(__INFO__) && !$userService->isLogin()) {
            $this->redirect(self::$loginPage);
        }
    }

    /**
     * 成功返回json
     * @param string $msg
     * @param $data
     */
    public function ajaxSuccess($msg = '操作成功', $data)
    {
        $this->ajaxReturn([
            'success' => 1,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    /**
     * 失败返回json
     * @param string $msg
     */
    public function ajaxError($msg = '操作失败')
    {
        $this->ajaxReturn([
            'success' => 0,
            'msg' => $msg
        ]);
    }

}