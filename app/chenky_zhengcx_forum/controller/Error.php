<?php
declare (strict_types = 1);

namespace app\chenky_zhengcx_forum\controller;

use app\BaseController;
use think\Request;

class Error extends BaseController
{
    /**
     * miss路由指向的方法
     */
    public function miss()
    {
        // 提示，跳转
        $this->error('你访问的地址不存在！','index/index');
    }

}
