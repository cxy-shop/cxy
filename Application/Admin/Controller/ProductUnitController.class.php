<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/28
 * Time: 下午2:55
 */

namespace Admin\Controller;


class ProductUnitController extends BaseController
{
    /**
     *  产品单位管理主界面
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 单位列表页面
     */
    public function lists()
    {
        $this->display();
    }

    public function getList()
    {
        $data = [
            [
                'text'  =>  '单位分组',
                'id'    =>  0,
                'items' =>  [
                    [
                        'text'  =>  '商品1',
                        'id'    =>  1,
                    ],
                    [
                        'text'  =>  '商品2',
                        'id'    =>  2,
                    ],
                    [
                        'text'  =>  '商品3',
                        'id'    =>  3,
                    ]
                ]
            ]
        ];
        $this->ajaxData($data);
    }
    /**
     * 获取产品单位列表
     */
//    public function getList()
//    {
//        $productUnitService = new ProductUnitModel();
//        $productUnitList = $productUnitService->scope('available')->select();
//
//        $this->ajaxData($productUnitList);
//    }
}