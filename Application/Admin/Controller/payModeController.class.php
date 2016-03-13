<?php
namespace Admin\Controller;

use Admin\Model\PayModeModel;
use Common\Controller\BaseController;

class PayModeController extends BaseController
{
    /**
     * 支付方式管理主界面
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 分页获取支付方式列表
     */
    public function getPayList()
    {
        $payModeService = new PayModeModel();
        $payList = $payModeService->page(1, 10)->select();
        $total = $payModeService->count();
        $data = [];
        for($i = 0;$i <10;$i++){
            $data[] = $payList[0];
        }
        $this->ajaxData([
            'data' => $data,
            'total' => 20
        ]);
    }

    /**
     * 单项页面
     */
    public function item()
    {
        $this->display();
    }

    /**
     * 新增页面
     */
    public function add()
    {
        $this->display();
    }

    /**
     * 新增操作
     */
    public function addHandle()
    {

    }

    /**
     * 编辑页面
     */
    public function edit()
    {
        $this->display();
    }

    /**
     * 编辑操作
     */
    public function editHandle()
    {

    }

    /**
     * 回收站页面
     */
    public function trash()
    {
        $this->display();
    }

    /**
     * 删除操作
     */
    public function removeHandle()
    {
        $id = I('id');

        $this->ajaxSuccess();
    }
}