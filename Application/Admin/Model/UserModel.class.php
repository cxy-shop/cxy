<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/10
 * Time: 上午8:23
 */
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{
    protected static $user = null;
    const userSymbol = 'user';
    /**
     * 判断是否登录
     * @return bool
     */
    public static function isLogin(){
        return !empty(session(self::userSymbol));
    }

    /**
     * 从session中获取用户信息
     * @return mixed
     */
    public static function getUser(){
        return session(self::userSymbol);
    }

    /**
     * 设置用户信息到session
     * @param $user
     */
    public static function setUser($user){
        session(self::userSymbol, $user);
    }

    /**
     * 验证用户密码是否正确
     * @param string $username
     * @param string $password
     * @return bool
     */
    public static function validatePassoword($username = '', $password = ''){
        $userModelService = new self();
        self::$user = $userModelService->where(['username' => $username])->find();
        //用户名不存在
        if ( empty(self::$user) ) return false;

        //判断用户密码是否正确
        if ( self::$user['password'] === $password ){
            return true;
        }else{
            return false;
        }

    }

    /**
     * 注册用户session信息
     */
    public static function registerUser(){
        if ( isset(self::$user['password']) ){
            unset(self::$user['password']);
        }
        self::setUser(self::$user);
    }

    /**
     * 销毁用户session
     */
    public static function destroyUser(){
        session(self::userSymbol, null);
        session(null);
    }
}