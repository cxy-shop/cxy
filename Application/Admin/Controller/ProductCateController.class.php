<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/17
 * Time: 下午6:43
 */
namespace Admin\Controller;


use Admin\Model\ProductCateModel;

class ProductCateController extends BaseController
{
    //内部使用的分类列表
    protected $_cateList = [];
    //子目录
    const subDirectory = 'productCate';
    /**
     *  产品分类管理主界面
     */
    public function index()
    {
        $this->display();
    }

    /**
     *  模块描述页面
     */
    public function remark()
    {
        $this->display();
    }

    /**
     * 组织分类列表成树形结构
     * @param int $parendId
     * @return array
     */
    public function combineCate($parendId = -1){
        $combineData = [];
        foreach($this->_cateList as $item){
            if ($item['parent_id'] == $parendId){
                $data = [
                    'text'  =>  $item['name'],
                    'id'    =>  $item['id']
                ];
                $childList = $this->combineCate($item['id']);
                $not_empty = !empty($childList);
                $data['hasChild'] = $not_empty;
                if ( $not_empty ){
                    $data['items'] = $childList;
                }
                $combineData[] = $data;
            }
        }
        return $combineData;
    }
    /**
     * 获取产品分类列表
     */
    public function getList()
    {
        $productCateService = new ProductCateModel();
        $this->_cateList = $productCateService->scope('available')->select();
        $this->_cateList[] = [
            'name'  =>  '商品分类',
            'parent_id'  => -1,
            'id'    =>  0
        ];
        $productCateList = $this->combineCate();
        $this->ajaxData($productCateList);
    }

    /**
     * 产品单位页面
     */
    public function unit(){
        $this->display();
    }

    /**
     * 单项页面
     */
    public function item()
    {
        $id = I('id', 0);
//        $payModeService = new PayModeModel();
//        $payMode = $payModeService->find($id);
//        $this->assign('payMode', $payMode);
        $this->display();
    }

    /**
     * 新增页面
     */
    public function add()
    {
        $parentId = I('parentId', 0);
        $this->assign('parentId', $parentId);
        if ($parentId == 0){
            $this->assign('parentName', '顶级分类');
        }else{
            $productCateService = new ProductCateModel();
            $parentName = $productCateService->find($parentId)['name'];
            $this->assign('parentName', $parentName);
        }
        $this->display();
    }
    /**
     * 新增操作
     */
    public function addHandle()
    {
        $productCateService = new ProductCateModel();
        $uploadCtrl = new UploadController();

        $res = true;
        $res = $productCateService->create();
        //修复未选择开启的情况下,没有字段,不参与自动完成
        $productCateService->enable = I('enable', 0);
        if ($res) {
            $res = $productCateService->add();
        }
        if ($res) {
            //移动logo到安全目录
            $filePath = I('iconPath');
            $uploadCtrl->moveImageToDir(self::subDirectory,$filePath);
            $this->ajaxSuccess('操作成功', $productCateService->find($res));
        } else {
            $this->ajaxFail($productCateService->getError());
        }

    }

    /**
     * 编辑页面
     */
    public function edit()
    {
        $id = I('id', 0);
        $productCateService = new ProductCateModel();
        $productCate = $productCateService->find($id);
        $this->assign('productCate', $productCate);
        $this->display();
    }

    /**
     * 编辑操作
     */
    public function editHandle()
    {
        $oldIconPath = I('oldIconPath', '');
        $newIconPath = I('iconPath', '');

        $productCateService = new ProductCateModel();
        $uploadCtrl = new UploadController();

        $res = $productCateService->create();
        $productCateService->enable = I('enable', 0);
        if ($res) {
            $res = $productCateService->save();
        }
        if ($res) {
            //判断是否修改了上传文件,如果有则需要删除旧的,移动新的到安全目录
            if ($oldImagePath != $newIconPath) {
                //从tmp目录移动新图片到安全目录
                $uploadCtrl->moveImageToDir(self::subDirectory, $newIconPath);
                //TODO 日志机制
                //删除原logo文件
                $uploadCtrl->safeUnlink(__STATIC_PATH__ . self::subDirectory .'/' . $oldIconPath);
            }
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($productCateService->getError());
        }
    }

    /**
     * 删除操作
     */
    public function removeHandle()
    {
        $id = I('id', 0);
        $productCateService = new ProductCateModel();
        //TODO 日志机制
        $res = $productCateService->cascadeDelete($id);
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($productCateService->getError());
        }

    }

}