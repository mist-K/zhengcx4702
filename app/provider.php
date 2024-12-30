<?php

use app\chenky_zhengcx_forum\controller\Mes;
use app\chenky_zhengcx_forum\controller\Section;
use app\chenky_zhengcx_forum\controller\Test;
use app\ExceptionHandle;
use app\Request;
use app\validate\FormCheck;

// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
    'test'                  =>  Test::class,
    'mes'                   =>  Mes::class,
    'section'               =>  Section::class,
    'fc'                    =>  FormCheck::class,
];

