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
    protected $user = null;
    /**
     * 判断是否登录
     * @return bool
     */
    public function isLogin(){
        return !empty(session('user'));
    }

    /**
     * 获取用户信息
     * @return mixed
     */
    public function getUser(){
        return session('user');
    }

    /**
     * 设置用户信息
     * @param $user
     */
    public function setUser($user){
        session('user', $user);
    }

    public function validatePassoword($username = '', $password = ''){
        $this->user = $this->where(['username' => $username])->find();

        if ($this->user['password'] === $password){
            return true;
        }else{
            return false;
        }

    }

    public function registerUser(){
        if ( isset($this->user['password']) ){
            unset($this->user['password']);
        }
        $this->setUser($this->user);
    }

    public function destroyUser(){
        session('user', null);
        session(null);
    }
}