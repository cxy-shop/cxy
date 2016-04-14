<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/28
 * Time: 下午2:55
 */

namespace Admin\Controller;

use Admin\Model\ProductUnitModel;

/**
 * 产品单位管理
 * Class ProductUnitController
 * @package Admin\Controller
 */
class ProductUnitController extends BaseController
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
     * 获取列表
     */
    public function getList()
    {
        $cateId = I('cateId',0);
        $productUnitService = new ProductUnitModel();
        $productUnitList = $productUnitService->scope('available')->where(['cate_id' => $cateId])->select();

        $this->ajaxData($productUnitList);
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
        $productUnitService = new ProductUnitModel();

        $res = true;
        $res = $productUnitService->create();
        if ($res) {
            $res = $productUnitService->add();
        }
        if ($res) {
            $this->ajaxData( $productUnitService->find($res) );
        } else {
            $this->ajaxFail($productUnitService->getError());
        }
    }

    /**
     * 编辑操作
     */
    public function editHandle()
    {
        $productUnitService = new ProductUnitModel();

        $data = $productUnitService->create();
        $res = null;
        if ($data) {
            $res = $productUnitService->save();
        }
        if ($res) {
            $this->ajaxData($data);
        } else {
            $this->ajaxFail($productUnitService->getError());
        }
    }

    /**
     * 删除操作
     */
    public function removeHandle()
    {
        $id = I('id',0);
        $productUnitService = new ProductUnitModel();

        $res = $productUnitService->delete($id);
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($productUnitService->getError());
        }
    }

}