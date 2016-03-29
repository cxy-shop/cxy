<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/28
 * Time: 下午3:08
 */
namespace Admin\Model;

use Common\Model\XModel;

class ProductCateModel extends XModel
{
    // 把表单字段映射到数据表的字段
    protected $_map = [
        'parentId' => 'parent_id',
        'unitSet' => 'unit_set',
        'unitIds' => 'unit_ids',
        'isDel' => 'is_del',
        'iconPath' => 'icon_path',
    ];
    //自动验证
    protected $_validate = [
        ['name', 'require', '名称必须！'], //验证必需字段
        ['parent_id', 'require', '父级分类必须！'], //验证必需字段
    ];
    //自动完成
    protected $_auto = [
        ['is_del', 0],  // 新增的时候把字段设置为0 未删除
        ['create_user_id', 'getCurrentUserId', self::MODEL_INSERT, 'callback'], // 对name字段在新增和编辑的时候回调getName方法
        ['last_edit_user_id', 'getCurrentUserId', self::MODEL_BOTH, 'callback'], // 对name字段在新增和编辑的时候回调getName方法
        ['create_time', 'getCurrentDatetime', self::MODEL_INSERT, 'callback'], // 对字段在新增的时候写入当前时间戳
        ['last_edit_time', 'getCurrentDatetime', self::MODEL_BOTH, 'callback'], // 对字段在新增和更新的时候写入当前时间戳
    ];
    //命名范围
    protected $_scope = [
        'available' => [
            'where' => [
                'is_del' => 0,
                'enable' => 1
            ]
        ]
    ];

    /**
     * 级连删除分类及其子分类
     */
    public function cascadeDelete($id){
        $this->startTrans();
        $res = true;
        $set = [$id];
        while( !empty($set) && $res){
            $id = array_pop($set);
            //排除虚拟的顶级分类ID
            if ($id != 0){
                $res = $this->delete($id);
            }
            $ids = $this->where(['parent_id' => $id])->getField('id',true);
            if ($ids){
                $set = array_merge($set, $ids);
            }
        }
        if ( !$res ){
            $this->rollback();
            return false;
        }else{
            $this->commit();
            return true;
        }
    }
}
