<?php
declare (strict_types = 1);

namespace app\middleware;

use Exception;

class ForumM
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //前置中间件
        // dump('这是前置中间件的行为');
        dump($request->action());
        if (strtolower($request->action()) == 'doreg') {
            # 注册
            $scene = 'reg';
            $data = [
                'unick'         =>      $request->post('unick','','trim'),
                'upwd'          =>      $request->post('upa','','trim'),
                'upwd2'         =>      $request->post('upa2','','trim'),
                'uemail'        =>      $request->post('uemail','','trim'),
                'u_tel'         =>      $request->post('utel','','trim'),
                'u_code'        =>      $request->post('ucode','','trim'),
            ];
        } elseif (strtolower($request->action()) == 'dologin') {
            # 登录
            $scene = '';
            $data = [];
        }
        try {
            // 验证
            // validate(app('fc')::class)
            validate(get_class(app('fc')))
            // 批量验证
            ->batch(true)
            ->scene($scene)
            ->check($data);
        } catch (Exception $th) {
            // throw $th
            halt($th->getMessage());
        }
        $r = $next($request);
        // 后置中间件
        dump('这是后置中间件的行为');
        // 返回的对象

    }
}
