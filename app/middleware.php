<?php
// 全局中间件定义文件

use app\middleware\ForumM;

return [
    // 全局请求缓存
    // \think\middleware\CheckRequestCache::class,
    // 多语言加载
    // \think\middleware\LoadLangPack::class,
    // Session初始化
    \think\middleware\SessionInit::class,
    // 注册ForumM为全局中间件
    // ForumM::class,
];
