<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/14
 * Time: 下午8:03
 */

/**
 * 增强model类
 */
namespace Common\Model;

use Think\Model;

class XModel extends Model
{
    protected function getCurrentUserId()
    {
        return UserModel::getUser()['id'];
    }

    protected function getCurrentDatetime()
    {
        return date("Y-m-d H:i:s", time());
    }

    /**
     * 以下是为了支持IDE感应而编写的方法
     * 'strict','order','alias','having','group','lock','distinct','auto','filter','validate','result','token','index','force'
     * 'count','sum','min','max','avg'
     */
    public function order()
    {
        parent::order(func_get_args());
        return $this;
    }

    public function strict()
    {
        parent::strict(func_get_args());
        return $this;
    }

    public function alias()
    {
        parent::alias(func_get_args());
        return $this;
    }

    public function having()
    {
        parent::having(func_get_args());
        return $this;
    }

    public function group()
    {
        parent::group(func_get_args());
        return $this;
    }

    public function lock()
    {
        parent::lock(func_get_args());
        return $this;
    }

    public function distinct()
    {
        parent::distinct(func_get_args());
        return $this;
    }

    public function auto()
    {
        parent::auto(func_get_args());
        return $this;
    }

    public function filter()
    {
        parent::filter(func_get_args());
        return $this;
    }

    public function validate()
    {
        parent::validate(func_get_args());
        return $this;
    }

    public function result()
    {
        parent::result(func_get_args());
        return $this;
    }

    public function token()
    {
        parent::token(func_get_args());
        return $this;
    }

    public function index()
    {
        parent::index(func_get_args());
        return $this;
    }

    public function force()
    {
        parent::force(func_get_args());
        return $this;
    }

    public function count()
    {
        $args = func_get_args();
        if (count($args) < 1){
            return parent::count();
        }else{
            return parent::count(func_get_arg(0));
        }

    }

    public function sum()
    {
        return parent::sum(func_get_args());
    }

    public function min()
    {
        return parent::min(func_get_args());
    }

    public function max()
    {
        return parent::max(func_get_args());
    }

    public function avg()
    {
        return parent::avg(func_get_args());
    }

}
