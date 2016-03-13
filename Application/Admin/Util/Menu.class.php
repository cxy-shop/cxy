<?php
namespace Admin\Util;
/**
 * 导航菜单工具类
 * @package Admin\Util
 */
class Menu
{
    public static $menuStructure = [
        [
            'title' => '基础数据',
            'iconClass' => 'glyphicon glyphicon-oil',
            'items' => [
                [
                    'title' => '商品管理',
                    'url' => '/admin/product/index'
                ],
                [
                    'title' => '商品分类管理',
                    'url' => '/admin/poductCate/index'
                ],
                [
                    'title' => '商品属性管理',
                    'ur;' => '/admin/productAttr/index'
                ],
                [
                    'title' => '商品单位管理',
                    'url' => '/admin/productUnit/index'
                ],
                [
                    'title' => '品牌管理',
                    'url' => '/admin/brand/index'
                ],
                [
                    'title' => '货架管理',
                    'url' => '/admin/shelf/index'
                ],
                [
                    'title' => '支付方式管理',
                    'url' => '/admin/payMode/index'
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
                ],
                [
                    'title' => '板块管理',
                    'url' => ''
                ]
            ]
        ],
        [
            'title' => '网站会员',
            'iconClass' => 'glyphicon glyphicon-user',
            'items' => [
                [
                    'title' => '会员管理',
                    'url' => ''
                ]
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