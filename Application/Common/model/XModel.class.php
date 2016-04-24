<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/14
 * Time: 下午8:03
 */

/**
 * 增强model类
 * hint: 这样只能提供自动完全功能,但解决不了链式调用方法跳转问题,这个对应用层代码并无大碍
 */
namespace Common\Model;

use Admin\Model\UserModel;
use Think\Model;

/**
 * 增强tp框架Model
 * Class XModel
 * @package Common\Model
 */
class XModel extends Model
{
    /**
     * 获得当前用户ID
     * @return mixed
     */
    protected function getCurrentUserId()
    {
        return UserModel::getUser()['id'];
    }

    /**
     * 获得系统当前datetime(Y-m-d H:i:s)格式的时间
     * @return bool|string
     */
    protected function getCurrentDatetime()
    {
        return date("Y-m-d H:i:s", time());
    }

    /**
     * 转成字符串
     * @param $value
     * @return string
     */
    public function toString($value){
        return strval($value);
    }
    /**
     * 分类筛选封装
     * @param int $id 分类ID
     * @param string $cateField 分类表字段
     * @return $this
     */
    public function category($id = 0, $cateField = 'cate_id'){
        if($id){
            $this->where([$cateField => $id]);
        }
        return $this;
    }
    /**
     * 丢入回收站或者删除记录
     * 如果没有删除就丢入回收站
     * 如果删除了就从数据库删除记录
     * @param $id
     * @return bool|mixed
     */
    public function toTrashOrDelete($id)
    {
        $item = $this->field('is_del')->find($id);
        $res = true;
        if (isset($item['is_del']) && $item['is_del'] == 0) {
            $data = [
                'is_del' => 1
            ];
            $res = $this->where('id=' . $id)->data($data)->save();
        } else {
            $res = $this->where('id=' . $id)->limit(1)->delete();
        }
        return $res;
    }

    /**
     * 组合filters数组信息后进行where
     * @param $filters
     * @return $this
     */
    public function combosWhere($filters)
    {
        $where = [];
        if (!empty($filters)) {
            $logic = 'and';
            if (isset($filters['filters'])) {
                $logic = $filters['logic'];
                $filters = $filters['filters'];
            }
            foreach ($filters as $filter) {

                if (!empty($this->_map)) {
                    foreach ($this->_map as $key => $val) {
                        if ($filter['field'] == $key) {
                            $filter['field'] = $val;
                        }
                    }
                }
                if (isset($filter['operator'])) {
                    switch ($filter['operator']) {
                        case 'startswith':
                            $where[$filter['field']] = ['LIKE', $filter['value'] . '%'];
                            break;
                    }
                } else {
                    $where[$filter['field']] = ['eq', $filter['value']];
                }
            }
        }
        $this->where($where);
        return $this;
    }

    /**
     * 以下是为了支持IDE方法自动提示而编写的方法
     * 'strict','order','alias','having','group','lock','distinct','auto','filter','validate','result','token','index','force'
     * 'count','sum','min','max','avg'
     * @param $arg
     * @return $this
     */

    /**
     * 增强order, 支持sort数组格式
     * @param $arg
     * @return $this
     */
    public function order($arg)
    {
        $order = $arg;
        if (is_array($arg)) {
            /**
             * 进行字段映射转换
             */
            foreach ($arg as &$sort) {
                if (!empty($this->_map)) {
                    foreach ($this->_map as $key => $val) {
                        if ($sort['field'] == $key) {
                            $sort['field'] = $val;
                        }
                    }
                }
            }
            /**
             * 连接成 字段 asc/desc,...形式
             */
            foreach ($arg as $sort) {
                $tmp[] = $sort['field'] . ' ' . $sort['dir'];
            }
            $order = '';
            $order .= implode(',', $tmp);
        }
        if (!empty($order)) {
            parent::order($order);
        }
        return $this;
    }

    /**
     * 将获取数据的字段名转成驼峰式格式(字段反映射)
     * @param null $arg
     * @return array|mixed
     */
    public function find($arg = null)
    {
        $data = [];
        $returnData = [];
        if (empty($arg)) {
            $data = parent::find();
        } else {
            $data = parent::find($arg);
        }
        $keys = array_keys($data);
        foreach ($keys as $fieldName) {
            $originFieldName = $fieldName;
            if (!empty($this->_map)) {
                foreach ($this->_map as $key => $val) {
                    if ($val == $fieldName) {
                        $fieldName = $key;
                        break;
                    }
                }
            }
            $returnData[$fieldName] = $data[$originFieldName];
        }
        return $returnData;
    }

    /**
     * 将获取数据的字段名转成驼峰式格式(字段反映射)
     * @param null $arg
     * @return array
     */
    public function select($arg = null)
    {
        $dataList = [];
        $returnDataList = [];

        if (empty($arg)) {
            $dataList = parent::select();
        } else {
            $dataList = parent::select($arg);
        }

        foreach ($dataList as $data) {
            $keys = array_keys($data);
            $returnData = [];
            foreach ($keys as $fieldName) {
                $originFieldName = $fieldName;
                if (!empty($this->_map)) {
                    foreach ($this->_map as $key => $val) {
                        if ($val == $fieldName) {
                            $fieldName = $key;
                            break;
                        }
                    }
                }
                $returnData[$fieldName] = $data[$originFieldName];
            }
            $returnDataList[] = $returnData;
        }
        return $returnDataList;
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
        if (count($args) < 1) {
            return parent::count();
        } else {
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
