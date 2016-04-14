<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/4/13
 * Time: 下午5:13
 */
namespace Admin\Controller;
use Admin\Model\ProductUnitGroupModel;

/**
 * 产品单位分组
 * Class ProductUnitGroupController
 * @package Admin\Controller
 */
class ProductUnitGroupController extends BaseController
{
    /**
     *  产品单位分组管理主界面
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 分组列表页面
     */
    public function lists()
    {
        $this->display();
    }

    /**
     * 新增界面
     */
    public function add(){
        $this->display();
    }

    /**
     * 新增操作
     */
    public function addHandle()
    {
        $productUnitGroupService = new ProductUnitGroupModel();

        $res = true;
        $res = $productUnitGroupService->create();
        if ($res) {
            $res = $productUnitGroupService->add();
        }
        if ($res) {
            $this->ajaxSuccess('操作成功', $productUnitGroupService->find($res));
        } else {
            $this->ajaxFail($productUnitGroupService->getError());
        }

    }

    /**
     * 编辑界面
     */
    public function edit(){
        $id = I('id', 0);
        $productUnitGroupService = new ProductUnitGroupModel();
        $productUnitGroup = $productUnitGroupService->find($id);
        $this->assign('productUnitGroup', $productUnitGroup);
        $this->display();
    }
    /**
     * 编辑操作
     */
    public function editHandle()
    {
        $productUnitGroupService = new ProductUnitGroupModel();

        $res = $productUnitGroupService->create();
        if ($res) {
            $res = $productUnitGroupService->save();
        }
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($productUnitGroupService->getError());
        }
    }

    //内部使用的待组合数据源
    protected $_willCombineList = [];
    /**
     * 组织分类列表成树形结构
     * @param int $parendId
     * @return array
     */
    public function combineDataSource($parendId = -1){
        $combineData = [];
        foreach($this->_willCombineList as $item){
            if (isset($item['parent_id']) && $item['parent_id'] == $parendId){
                $data = [
                    'text'  =>  $item['name'],
                    'id'    =>  $item['id']
                ];
                $childList = $this->combineDataSource($item['id']);
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
     * 获取分组数据源
     */
    public function getList()
    {
        $productUnitGroupService = new ProductUnitGroupModel();
        $this->_willCombineList = $productUnitGroupService->scope('available')->select();
        $this->_willCombineList[] = [
            'name'  =>  '单位分组',
            'parent_id'  => -1,
            'id'    =>  0
        ];
        $productUnitGroupList = $this->combineDataSource();
        $this->ajaxData($productUnitGroupList);
    }

    /**
     * 删除操作
     */
    public function removeHandle()
    {
        $id = I('id', 0);
        $productUnitGroupService = new ProductUnitGroupModel();

        $res = $productUnitGroupService->delete($id);
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($productUnitGroupService->getError());
        }

    }

}