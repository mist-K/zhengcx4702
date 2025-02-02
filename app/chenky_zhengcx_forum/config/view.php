<?php
// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
    // 模板引擎类型使用Think
    'type'          => 'Think',
    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写 3 保持操作方法
    'auto_rule'     => 2,
    // 模板目录名
    'view_dir_name' => 'view',
    // 模板后缀
    'view_suffix'   => 'html',
    // 模板文件名分隔符
    'view_depr'     => DIRECTORY_SEPARATOR,
    // 模板引擎普通标签开始标记
    'tpl_begin'     => '{',
    // 模板引擎普通标签结束标记
    'tpl_end'       => '}',
    // 标签库标签开始标记
    'taglib_begin'  => '{',
    // 标签库标签结束标记
    'taglib_end'    => '}',
    // 模板替换字符串的定义
    'tpl_replace_string'    =>      [
        '__IMG__'   =>      env('LABpath.img','/static/chenky_zhengcx_forum/img'),
        '__CSS__'   =>      env('LABpath.CSS','/static/chenky_zhengcx_forum/CSS'),
        '__JS__'    =>      env('LABpath.JS','/static/chenky_zhengcx_forum/JS'),
        '__PORTRAIT__'    =>      env('LABpath.portrait','/static/chenky_zhengcx_forum/upload/portrait'),
        '__UIMG__'    =>      env('LABpath.uimg','/static/chenky_zhengcx_forum/uimg'),
    ]
];
