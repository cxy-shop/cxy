<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/4/13
 * Time: 下午8:42
 */
namespace Admin\Model;

use Common\Model\XModel;

class ProductUnitModel extends XModel
{
    // 把表单字段映射到数据表的字段
    protected $_map = [
        'cateId'    =>  'cate_id'
    ];
    //自动验证
    protected $_validate = [
        ['name', 'require', '名称必须！',self::MUST_VALIDATE], //验证必需字段
        ['cate_id', 'require', '分组必须！',self::EXISTS_VALIDATE ]
    ];
    //自动完成
    protected $_auto = [
        ['create_user_id', 'getCurrentUserId', self::MODEL_INSERT, 'callback'], // 对name字段在新增和编辑的时候回调getName方法
        ['last_edit_user_id', 'getCurrentUserId', self::MODEL_BOTH, 'callback'], // 对name字段在新增和编辑的时候回调getName方法
        ['create_time', 'getCurrentDatetime', self::MODEL_INSERT, 'callback'], // 对字段在新增的时候写入当前时间戳
        ['last_edit_time', 'getCurrentDatetime', self::MODEL_BOTH, 'callback'], // 对字段在新增和更新的时候写入当前时间戳
    ];
    //命名范围
    protected $_scope = [
        'available' =>  []
    ];
}