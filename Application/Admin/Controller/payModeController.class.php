<?php
namespace Admin\Controller;

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
        $this->display();
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
        $this->display();
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
        $this->display();
    }
}