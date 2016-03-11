<?php
namespace Admin\Util;
class Menu
{
    public static $menuStructure = [
        [
            'title' => '基础数据',
            'iconClass' => 'glyphicon glyphicon-oil',
            'items' => [
                [
                    'title' => '商品管理',
                    'url' => '/admin/product/list'
                ],
                [
                    'title' => '商品分类管理',
                    'url' => '/admin/poductCate/list'
                ],
                [
                    'title' => '商品单位管理',
                    'url' => 'admin/productUnit/list'
                ]
            ]
        ],
        [
            'title' => '网站管理',
            'iconClass' => 'glyphicon glyphicon-modal-window',
            'items' => [
                [
                    'title' => '首页管理',
                    'url' => ''
                ],
                [
                    'title' => '导航管理',
                    'url' => ''
                ]
            ]
        ],
        [
            'title' => '组织架构',
            'iconClass' => 'glyphicon glyphicon-user',
            'items' => [

            ]
        ],
        [
            'title' => '系统设置',
            'iconClass' => 'glyphicon glyphicon-cog',
            'items' => [

            ]
        ]

    ];

    /**
     * 生成菜单结构
     * @param bool $auth 为真,则经过权限筛选过滤菜单
     * @return string
     */
    public static function generate($auth = false)
    {
        if (!$auth) {
            return self::$menuStructure;
        }
        //TODO 权限筛选待做
        return [];
    }
}