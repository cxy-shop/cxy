<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/28
 * Time: 下午2:59
 */

namespace Admin\Controller;
use Admin\Model\StoreModel;

/**
 * 店铺管理
 * Class StoreController
 * @package Admin\Controller
 */
class StoreController extends BaseController
{
    /**
     * 管理主界面
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
     * 获取列表数据
     */
    public function getList()
    {
        $page = I('page', 1);   //页码
        $pageSize = I('pageSize', 10);  //页数
        $storeService = new StoreModel();
        $storeList = $storeService->scope('available')->page($page,$pageSize)->select();
        $total = $storeService->scope('available')->count();
        $this->ajaxData([
            'data'  =>  $storeList,
            'total' =>  $total
        ]);
    }

    /**
     * 列表页面
     */
    public function lists()
    {
        $this->display();
    }

    /**
     * 新增操作
     */
    public function addHandle()
    {
        $storeService = new StoreModel();

        $res = true;
        $res = $storeService->create();
        if ($res) {
            $res = $storeService->add();
        }
        if ($res) {
            $this->ajaxData( $storeService->find($res) );
        } else {
            $this->ajaxFail($storeService->getError());
        }
    }

    /**
     * 编辑操作
     */
    public function editHandle()
    {
        $storeService = new StoreModel();

        $data = $storeService->create();
        $res = null;
        if ($data) {
            $res = $storeService->save();
        }
        if ($res) {
            $this->ajaxData($data);
        } else {
            $this->ajaxFail($storeService->getError());
        }
    }

    /**
     * 删除操作
     */
    public function removeHandle()
    {
        $id = I('id',0);
        $storeService = new StoreModel();
        $res = $storeService->delete($id);
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($storeService->getError());
        }
    }

}