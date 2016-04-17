<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/28
 * Time: 下午2:58
 */

namespace Admin\Controller;
use Admin\Model\BrandCateModel;

/**
 * 品牌分类管理
 * Class BrandCateController
 * @package Admin\Controller
 */
class BrandCateController extends BaseController
{
    /**
     *  管理主界面
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 列表页面
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
        $brandCateService = new BrandCateModel();

        $res = true;
        $res = $brandCateService->create();
        if ($res) {
            $res = $brandCateService->add();
        }
        if ($res) {
            $this->ajaxSuccess('操作成功', $brandCateService->find($res));
        } else {
            $this->ajaxFail($brandCateService->getError());
        }

    }

    /**
     * 编辑界面
     */
    public function edit(){
        $id = I('id', 0);
        $brandCateService = new BrandCateModel();
        $item = $brandCateService->find($id);
        $this->assign('item', $item);
        $this->display();
    }
    /**
     * 编辑操作
     */
    public function editHandle()
    {
        $brandCateService = new BrandCateModel();

        $res = $brandCateService->create();
        if ($res) {
            $res = $brandCateService->save();
        }
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($brandCateService->getError());
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
            if (isset($item['parentId']) && $item['parentId'] == $parendId){
                $data = [
                    'text'  =>  $item['name'],
                    'id'    =>  $item['id']
                ];
                $childList = $this->combineDataSource($item['id']);
                $notEmpty = !empty($childList);
                $data['hasChild'] = $notEmpty;
                if ( $notEmpty ){
                    $data['items'] = $childList;
                }
                $combineData[] = $data;
            }
        }
        return $combineData;
    }

    /**
     * 获取数据源
     */
    public function getList()
    {
        $brandCateService = new BrandCateModel();
        $this->_willCombineList = $brandCateService->scope('available')->select();
        $this->_willCombineList[] = [
            'name'  =>  '品牌分类',
            'parentId'  => -1,
            'id'    =>  0
        ];
        $brandList = $this->combineDataSource();
        $this->ajaxData($brandList);
    }

    /**
     * 删除操作
     */
    public function removeHandle()
    {
        $id = I('id', 0);
        $brandCateService = new BrandCateModel();

        $res = $brandCateService->delete($id);
        if ($res) {
            $this->ajaxSuccess();
        } else {
            $this->ajaxFail($brandCateService->getError());
        }

    }

}