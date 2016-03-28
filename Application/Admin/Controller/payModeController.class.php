<?php
namespace Admin\Controller;

use Admin\Model\PayModeModel;

class PayModeController extends BaseController
{
    /**
     * 支付方式管理主界面
     */
    public function index()
    {
//        $payModeService = new PayModeModel();
//        $payModeList = $payModeService->where('enable = 0')->select();
//        var_dump($payModeList);
        $this->display();
    }

    /**
     * 分页获取支付方式列表
     */
    public function getPayList()
    {
        $filters = I('filter',[]);   //过滤参数数组
        $sorts = I('sort',[
            [
                'field' => 'name',
                'dir' =>  'asc'
            ]
        ]);   //排序参数数组,需要设置默认排序字段
        $page = I('page', 1);
        $pageSize = I('pageSize', 10);

        $payModeService = new PayModeModel();
        $payModeList = $payModeService->combosWhere($filters)->order($sorts)->page(1, 10)->select();
        $total = $payModeService->count();
        $this->ajaxData([
            'data' => $payModeList,
            'total' => $total
        ]);
    }

    /**
     * 单项页面
     */
    public function item()
    {
        $id = I('id',0);
        $payModeService = new PayModeModel();
        $payMode = $payModeService->find($id);
        $this->assign('payMode', $payMode);
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
        $payModeService = new PayModeModel();
        $uploadCtrl = new UploadController();

        $res = true;
        $res = $payModeService->create();
        $payModeService->enable = I('enable', 0);
        if ( $res ){
            $res = $payModeService->add();
        }

        if ( $res ){
            //移动logo到安全目录
            $filePath= I('logoPath');
            $uploadCtrl->moveImageToDir('payMode',$filePath);

            $this->ajaxSuccess();
        }else{
            $this->ajaxFail( $payModeService->getError() );
        }

    }

    /**
     * 编辑页面
     */
    public function edit()
    {
        $id = I('id', 0);
        $payModeService = new PayModeModel();
        $payMode = $payModeService->find($id);
        $this->assign('payMode', $payMode);
        $this->display();
    }

    /**
     * 编辑操作
     * 编辑需要获得原来的logoPath,删除原来的logoPath
     */
    public function editHandle()
    {
        $oldLogoPath = I('oldLogoPath', '');
        $newLogoPath = I('logoPath', '');
        $payModeService = new PayModeModel();
        $uploadCtrl = new UploadController();
        $res = $payModeService->create();
        $payModeService->enable = I('enable', 0);
        if ($res){
            $res = $payModeService->save();
        }
        if ($res){
            if($oldLogoPath != $newLogoPath){
                //从tmp目录移动新logo到安全目录
                $uploadCtrl->moveImageToDir('payMode', $newLogoPath);
                //删除原logo文件
                $uploadCtrl->safeUnlink(__STATIC_PATH__ .'payMode/' .$oldLogoPath);
            }
            $this->ajaxSuccess();
        }else{
            $this->ajaxFail( $payModeService->getError() );
        }
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
        $id = I('id', 0);
        $payModelService = new PayModeModel();
        //这里涉及到图片,不能这么写,从数据删除的时候,对应的图片也应该删除,并且留下删除文件备份机制
        $res = $payModelService->toTrashOrtoDelete($id);
        if ($res){
            $this->ajaxSuccess();
        }else{
            $this->ajaxFail( $payModelService->getError() );
        }

    }

    /**
     * 切换启用状态
     */
    public function toggleEnable(){
        $id = I('id', 0);
        $enable = I('enable', 0);
        $payModelService = new PayModeModel();
        $data = [
            'id'  =>  $id,
            'enable'    =>  $enable
        ];
        $res = $payModelService->save($data);
        if ($res){
            $this->ajaxSuccess();
        }else{
            $this->ajaxFail();
        }
    }



}