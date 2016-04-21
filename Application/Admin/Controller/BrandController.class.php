<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/4/14
 * Time: 下午10:34
 */

namespace Admin\Controller;
use Admin\Model\BrandModel;

/**
 * 品牌管理
 * Class BrandController
 * @package Admin\Controller
 */
class BrandController extends BaseController
{
    /**
     *  管理主界面
     */
    public function index()
    {
        $this->display();
    }
    /**
     * 介绍页面
     */
    public function remark(){
        $this->display();
    }
    /**
     * 介绍页面
     */
    public function form(){
        $this->display();
    }

    /**
     * 获取列表
     */
    public function getList()
    {
        $cateId = I('cateId',0);    //分类ID
        $page = I('page', 1);   //页码
        $pageSize = I('pageSize', 10);  //页数
        $brandService = new BrandModel();
        $productUnitList = $brandService->scope('available')->where(['cate_id' => $cateId])->page($page,$pageSize)->select();
        $total = $brandService->scope('available')->where(['cate_id' => $cateId])->count();
        $this->ajaxData([
            'data'  =>  $productUnitList,
            'total' =>  $total
        ]);
    }

    /**
     * 列表页面
     */
    public function lists()
    {
        $cateId = I('cateId', 0);
        $this->assign('cateId', $cateId);
        $this->display();
    }

    /**
     * 新增操作
     */
    public function addHandle()
    {
        $brandService = new BrandModel();

        $res = true;
        $res = $brandService->create();
        if ($res) {
            $res = $brandService->add();
        }
        if ($res) {
            $this->ajaxData( $brandService->find($res) );
        } else {
            $this->ajaxFail($brandService->getError());
        }
    }

    /**
     * 编辑操作
     */
    public function editHandle()
    {
        $brandService = new BrandModel();

        $data = $brandService->create();
        $res = null;
        if ($data) {
            $res = $brandService->save();
        }
        if ($res) {
            $this->ajaxData($data);
        } else {
            $this->ajaxFail($brandService->getError());
        }
    }

    /**
     * 删除操作
     */
    public function removeHandle()
    {
        $id = I('id',0);
        $brandService = new BrandModel();
        $res = $brandService->delete($id);
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($brandService->getError());
        }
    }

}