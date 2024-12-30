<?php

return [
    // 默认使用的数据库连接配置
    'default'         => env('FORUM_DB_R.DB_DRIVER', 'forum_r'),

    // 数据库连接配置信息
    'connections'     => [
        'forum_r' => [
            // 数据库类型
            'type'            => env('FORUM_DB_R.DB_TYPE', 'mysql'),
            // 服务器地址
            'hostname'        => env('FORUM_DB_R.DB_HOST', '127.0.0.1'),
            // 数据库名
            'database'        => env('FORUM_DB_R.DB_NAME', 'chenky_zhengcx_forum'),
            // 用户名
            'username'        => env('FORUM_DB_R.DB_USER', 'chenky_zhengcx'),
            // 密码
            'password'        => env('FORUM_DB_R.DB_PASS', '87654321'),
            // 端口
            'hostport'        => env('FORUM_DB_R.DB_PORT', '3306'),
            // 数据库连接参数
            'params'          => [],
            // 数据库编码默认采用utf8
            'charset'         => env('DB_CHARSET', 'utf8'),
            // 数据库表前缀
            'prefix'          => env('DB_PREFIX', 'chenky_zhengcx'),

            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy'          => 0,
            // 数据库读写是否分离 主从式有效
            'rw_separate'     => false,
            // 读写分离后 主服务器数量
            'master_num'      => 1,
            // 指定从服务器序号
            'slave_no'        => '',
            // 是否严格检查字段是否存在
            'fields_strict'   => true,
            // 是否需要断线重连
            'break_reconnect' => false,
            // 监听SQL
            'trigger_sql'     => env('APP_DEBUG', true),
            // 开启字段缓存
            'fields_cache'    => false,
        ],
        'forum_ru' => [
            // 数据库类型
            'type'            => env('FORUM_DB_R.DB_TYPE', 'mysql'),
            // 服务器地址
            'hostname'        => env('FORUM_DB_R.DB_HOST', '127.0.0.1'),
            // 数据库名
            'database'        => env('FORUM_DB_R.DB_NAME', 'chenky_zhengcx_forum'),
            // 用户名
            'username'        => env('FORUM_DB_RU.DB_USER', 'chenky_'),
            // 密码
            'password'        => env('FORUM_DB_RU.DB_PASS', '12345678'),
            // 端口
            'hostport'        => env('FORUM_DB_R.DB_PORT', '3306'),
            // 数据库连接参数
            'params'          => [],
            // 数据库编码默认采用utf8
            'charset'         => env('DB_CHARSET', 'utf8'),
            // 数据库表前缀
            'prefix'          => env('DB_PREFIX', 'chenky_zhengcx'),

            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy'          => 0,
            // 数据库读写是否分离 主从式有效
            'rw_separate'     => false,
            // 读写分离后 主服务器数量
            'master_num'      => 1,
            // 指定从服务器序号
            'slave_no'        => '',
            // 是否严格检查字段是否存在
            'fields_strict'   => true,
            // 是否需要断线重连
            'break_reconnect' => false,
            // 监听SQL
            'trigger_sql'     => env('APP_DEBUG', true),
            // 开启字段缓存
            'fields_cache'    => false,
        ],
        'forum_rc' => [
            // 数据库类型
            'type'            => env('FORUM_DB_R.DB_TYPE', 'mysql'),
            // 服务器地址
            'hostname'        => env('FORUM_DB_R.DB_HOST', '127.0.0.1'),
            // 数据库名
            'database'        => env('FORUM_DB_R.DB_NAME', 'chenky_zhengcx_forum'),
            // 用户名
            'username'        => env('FORUM_DB_RC.DB_USER', 'zhengcx_'),
            // 密码
            'password'        => env('FORUM_DB_RC.DB_PASS', '123456789'),
            // 端口
            'hostport'        => env('FORUM_DB_R.DB_PORT', '3306'),
            // 数据库连接参数
            'params'          => [],
            // 数据库编码默认采用utf8
            'charset'         => env('DB_CHARSET', 'utf8'),
            // 数据库表前缀
            'prefix'          => env('DB_PREFIX', 'chenky_zhengcx'),

            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy'          => 0,
            // 数据库读写是否分离 主从式有效
            'rw_separate'     => false,
            // 读写分离后 主服务器数量
            'master_num'      => 1,
            // 指定从服务器序号
            'slave_no'        => '',
            // 是否严格检查字段是否存在
            'fields_strict'   => true,
            // 是否需要断线重连
            'break_reconnect' => false,
            // 监听SQL
            'trigger_sql'     => env('APP_DEBUG', true),
            // 开启字段缓存
            'fields_cache'    => false,
        ],

        // 更多的数据库配置信息
    ],
];
