<?php

return [
    [
        'name' => '升级爱心使者分享人数',
        'key' => 'grade_sz_share_limit',
        'value' => '3',
        'weight' => '0',
        'description' => '分享多少人后可以升级成爱心使者并开始排队',
        'options' => [
            'validator' => 'in',
            'params' => [
                'range' => ['1', '2', '3']
            ]
        ],
    ],
    [
        'name' => '分享购买收益',
        'key' => 'kclass_zy_earning',
        'value' => '20',
        'weight' => '5',
        'description' => '爱心专员直接分享会员购买收益，共三次收益机会',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '二星使者收益',
        'key' => 'kclass_sz2_earning',
        'value' => '43',
        'weight' => '10',
        'description' => '二星使者共3次收益机会',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '三星使者收益',
        'key' => 'kclass_sz3_earning',
        'value' => '31',
        'weight' => '20',
        'description' => '三星使者共9次收益机会',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '一星大使收益',
        'key' => 'kclass_ds1_earning',
        'value' => '45',
        'weight' => '30',
        'description' => '一星大使共27次收益机会',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '二星大使收益',
        'key' => 'kclass_ds2_earning',
        'value' => '36',
        'weight' => '40',
        'description' => '二星大使共81次收益机会',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '三星大使收益',
        'key' => 'kclass_ds3_earning',
        'value' => '26',
        'weight' => '50',
        'description' => '三星大使共243次收益机会',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '升级爱心大使要求',
        'key' => 'ds_grade_requirements',
        'value' => '1-3-9',
        'weight' => '60',
        'description' => '要求分为 1-3-9 和 1-3-3-9 型两种，请严格按照格式设置',
        'options' => [
            'validator' => 'in',
            'params' => [
                'range' => ['1-3-9','1-3-3-9']
            ]                
        ]
    ],
    [
        'name' => '提现手续费',
        'key' => 'charge_rate',
        'value' => '0.03',
        'weight' => '70',
        'description' => '0.03 代表 3% 的手续费率，请严格按照小数点形式设置',
        'options' => [
            'validator' => 'match',
            'params' => [
                'pattern' => '/^0\.[0-9]{2}$/'
            ],
        ]
    ],
    [
        'name' => '三星大使沉淀资金',
        'key' => 'ds3_sediment_amount',
        'value' => '520',
        'weight' => '80',
        'description' => '升级到三星大使后必须沉淀到账户的资金',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '收益树默认展示层数',
        'key' => 'revenue_tree_depth',
        'value' => '7',
        'weight' => '90',
        'description' => '后台收益树界面默认向下展示几层收益结点',
        'options' => [
            'validator' => 'integer',
        ],
    ],
    [
        'name' => '图片服务器域名',
        'key' => 'image_host',
        'value' => 'http://app-img.senaifund.com',
        'weight' => '100',
        'description' => '用户在富文本编辑器中上传的图片通过这个域名访问',
    ],
    [
        'name' => '用户注册推荐人开关',
        'key' => 'need_sharer_when_register',
        'value' => '1',
        'weight' => '105',
        'description' => '可选值为 0 和 1，设置为 1 注册时必须填写推荐人',
        'options' => [
            'validator' => 'in',
            'params' => [
                'range' => ['0', '1'],
            ]
        ]
    ],
    [
        'name' => '[模拟用]关闭手机验证码',
        'key' => 'disable_verify_code',
        'value' => '0',
        'weight' => '110',
        'description' => '可选值为 0 和 1，设置为 1 注册时不验证手机验证码',
        'options' => [
            'validator' => 'in',
            'params' => [
                'range' => ['0', '1']
            ]
        ],
    ],
    [
        'name' => '[模拟用]避开支付直接生成订单',
        'key' => 'disable_korder_pay',
        'value' => '0',
        'weight' => '120',
        'description' => '可选值为 0 和 1，设置为 1 时提交订单后不需支付就能报单',
        'options' => [
            'validator' => 'in',
            'params' => [
                'range' => ['0', '1']
            ]
        ],
    ],
    [
        'name' => '[审核用]是否打开苹果客户端支付功能',
        'key' => 'disable_app_korder_view',
        'value' => '0',
        'weight' => '130',
        'description' => '可选值为 0 和 1，设置为 1 iOS客户端点击立即购买时显示线下交易提示',
        'options' => [
            'validator' => 'in',
            'params' => [
                'range' => ['0', '1']
            ]
        ],
    ],
    [
        'name' => '安卓App下载地址',
        'key' => 'android_app_download_url',
        'value' => 'https://www.pgyer.com/sazx',
        'weight' => '140',
        'description' => '第三方平台地址',
    ],
    [
    	'name' => '安全码',
    	'key' => 'safty_code',
    	'value' => '1801379',
    	'weight' => '200',
    	'description' => '在某些需要密码提升安全性的接口使用',
    	'options' => [
    		'validator' => 'string',
    		'params' => [
    			'min' => 1,
    		]
    	]
    ],
    
];

?>