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
                    'url' => '/admin/productCate/index'
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
                ],
                [
                    'title' => '店面信息管理',
                    'url' => '/admin/store/index'
                ]
            ]
        ],
        [
            'title' => '网站管理',
            'iconClass' => 'glyphicon glyphicon-modal-window',
            'items' => [
                [
                    'title' => '网站配置',
                    'url' => '/admin/website/index'
                ],
                [
                    'title' => '栏目管理',
                    'url' => ''
                ],
                [
                    'title' => '文章管理',
                    'url' => ''
                ]
            ]
        ],
        [
            'title' => '订单管理',
            'iconClass' => 'glyphicon glyphicon-user',
            'items' => [
                [
                    'title' => '销售订单管理',
                    'url' => ''
                ],
                [
                    'title' => '采购订单管理',
                    'url' => ''
                ]
            ]
        ],
        [
            'title' => '仓库管理',
            'iconClass' => 'glyphicon glyphicon-user',
            'items' => [
                [
                    'title' => '销售订单管理',
                    'url' => ''
                ],
                [
                    'title' => '采购订单管理',
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
            'title' => '网站促销',
            'iconClass' => 'glyphicon glyphicon-user',
            'items' => [
                [
                    'title' => ' 促销规则',
                    'url' => ''
                ],
                [
                    'title' => ' 促销活动',
                    'url' => ''
                ]
            ]
        ],
        [
            'title' => '网站客服',
            'iconClass' => 'glyphicon glyphicon-user',
            'items' => [
                [
                    'title' => ' 投诉建议',
                    'url' => ''
                ]
            ]
        ],
        [
            'title' => ' 组织架构',
            'iconClass' => 'glyphicon glyphicon-user',
            'items' => [
                [
                    'title' => '人员管理',
                    'url' => ''
                ],
                [
                    'title' => '部门管理',
                    'url' => ''
                ],
                [
                    'title' => '职位管理',
                    'url' => ''
                ]
            ]
        ],
        [
            'title' => '系统设置',
            'iconClass' => 'glyphicon glyphicon-cog',
            'items' => [
                [
                    'title' => '系统配置',
                    'url' => ''
                ],
                [
                    'title' => '权限管理',
                    'url' => ''
                ],
                [
                    'title' => '业务流程管理',
                    'url' => ''
                ]
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