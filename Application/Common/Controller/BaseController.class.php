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
        'admin/system/loginvalidate',
        'admin/system/logouthandle'
    ];

    public static function isIgnoreUrl($url)
    {
        return in_array(strtolower($url), self::$ignoreUrl);
    }

    /**
     *权限检测
     */
    protected function _initialize()
    {
        if (!self::isIgnoreUrl(__INFO__) && !UserModel::isLogin()) {
            if (IS_AJAX){
                $this->ajaxFail('没有权限!');
            }else{
                $this->redirect(self::$loginPage);
            }
            die;
        }
    }

    /**
     * 成功返回json
     * @param string $msg
     * @param $data
     */
    public function ajaxSuccess($msg = '操作成功', $data=[])
    {
        $this->ajaxReturn([
            'success' => 1,
            'msg' => $msg,
            'data' => $data
        ]);
        die;
    }

    /**
     * 失败返回json
     * @param string $msg
     */
    public function ajaxFail($msg = '操作失败')
    {
        $this->ajaxReturn([
            'success' => 0,
            'msg' => $msg
        ]);
        die;
    }

    /**
     * 返回json数据
     * @param array $data
     */
    public function ajaxData($data = [])
    {
        $this->ajaxReturn($data);
        die;
    }


}