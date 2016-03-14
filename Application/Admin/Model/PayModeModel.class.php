<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/10
 * Time: 上午8:23
 */
namespace Admin\Model;
use Common\Model\XModel;
use Think\Model;
class PayModeModel extends XModel
{
    // 把表单字段映射到数据表的字段
    protected $_map = [
        'isDel' =>'is_del',
        'logoPath'  =>'logo_path',
    ];
    //自动验证
    protected $_validate = [
        ['name','require','名称必须！'], //验证必需字段
        ['logo_path','require','logo必须！'], //验证必需字段
        ['name', '', '名称已经存在！', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH], // 在新增和编辑的时候验证字段是否唯一
    ];
    //自动完成
    protected $_auto = [
        ['is_del',0],  // 新增的时候把字段设置为0 未删除
        ['create_user_id','getCurrentUserId',self::MODEL_INSERT,'callback'], // 对name字段在新增和编辑的时候回调getName方法
        ['last_edit_user_id','getCurrentUserId',self::MODEL_BOTH,'callback'], // 对name字段在新增和编辑的时候回调getName方法
        ['create_time','getCurrentDatetime',self::MODEL_INSERT,'callback'], // 对字段在新增的时候写入当前时间戳
        ['last_edit_time','getCurrentDatetime',self::MODEL_BOTH,'callback'], // 对字段在新增和更新的时候写入当前时间戳
    ];

}
