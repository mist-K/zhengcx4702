<?php  
// 2203010201+2203010247
namespace app\chenky_zhengcx_forum\controller;

// use think\facade\View;
use app\BaseController;
use Exception;
use think\exception\ValidateException;

// use think\facade\Cookie;
// use think\facade\Db;
// use think\facade\Filesystem;
// use think\facade\Request;
// use think\facade\Session;
// use think\Filesystem as ThinkFilesystem;

class User extends BaseController
{  
    protected $middleware = [
        'FM'        =>      ['only'     =>      ['doreg']],
    ];
    /*
    * 登录验证
    */
    function doLogIn()
    {
        // 请求表单元素的值
        $uNick = $this->request->post('unick','','trim');
        $uPwd = $this->request->post('upa','','trim,md5');
        // dump($uNick);
        // dump($uPwd);
        // die();

        // 登录验证
        // 链式查询的第一梯队方法介绍：connect、name、table
        // connect：选择备用方案连接服务器
        // 结果：think\db\connector\Mysql对象
        // 总结：选择备用方案; 如果选择默认方案可以忽略;
        $re = app('db')->connect('forum_r');
        // name|table：打开表
        // 结果：think\db\Query对象
        $re = $re->table('chenky_zhengcx_user');
        // 结果：think\db\Query对象
        // $re = $re->name('user');
        // 省略connect方法的调用格式，调用的是默认的连接方案
        // 结果：think\db\Query对象
        // $re = Db::name('user');
        // 总结：第一梯队的方法顺序不能打乱

        // 第二梯队的方法：where、field、limit、order等
        // 都属于Query对象
        // 结果都是Query对象
        // 带*的方法可以多次出现
        // where：and查询
        // 结果：think\db\Query对象
        $re = $re->where('u_nick|u_email|u_tel','=',$uNick)
                ->where('u_pa',$uPwd);
        // field：标识要操作的字段
        // 结果：think\db\Query对象
        // $re = $re->field('u_nick,u_tel,u_img');
        // 总结：第二梯队的方法没有固定顺序

        // 第三梯队，设置CURD的方法
        // 查询：select和find
        // select：数据集
        // 结果：think\Collection对象
        // 查询不为空，内部用数组保存记录的值
        // 查询为空，内部是一个空数组
        // $re = $re->select();
        // if ($re->isEmpty()) {
        //     # 查询为空
        // } else {
        //     # 查询不为空
        // }
        
        // find方法：只查一条记录，适合于登录验证等查询
        // 查不到，返回null
        // 查到了，返回array
        // $re = $re->find();
        $re = $re
        ->field('u_nick,u_img')
        ->find();
        if ($re == null) {
            # 查询为空，登录失败
            $this->error('登录失败!','user/login');
        } else {
            # 查询不为空，登录成功
            // 发放票框
            // Session::set('uNick',$uNick);
            // Cookie::set('uImg',$re['u_img']);
            app('session')->set('uNick',$re['u_nick']);
            app('cookie')->set('uImg',$re['u_img'],24*60*60);
            $this->success('登录成功!','index/index');
        }

        dump($re);
    }

     /*
    * 登录表单的页面
    */
    public function Login()
    {
        return app('view')->fetch();
    }

    public function reg()  
    {  
        return app('view')->fetch();
    }  

    function logOut()
    {
        // 查票
        $this->check();
        // 删除会话和cookie变量
        app('session')->clear();
        app('cookie')->delete('uImg');
        // 提示跳转
        $this->success('注销成功!','index/index');
    }

    public function doReg()
    {
        // try {
        //     // 验证
        //     validate(app('fc')::class)
        //     // 批量验证
        //     ->batch(true)
        //     ->scene('reg')
        //     ->check([
        //         'unick'         =>      $this->request->post('unick','','trim'),
        //         'upwd'          =>      $this->request->post('upa','','trim'),
        //         'upwd2'         =>      $this->request->post('upa2','','trim'),
        //         'uemail'        =>      $this->request->post('uemail','','trim'),
        //         'u_tel'         =>      $this->request->post('utel','','trim'),
        //         'u_code'        =>      $this->request->post('ucode','','trim'),
        //     ]);
        // } catch (Exception $th) {
        //     // throw $th
        //     halt($th->getMessage());
        // }

        // 组织要写入的数值
        $data = [
            'u_nick'        =>      $this->request->post('unick','','trim'),
            'u_pwd'          =>      $this->request->post('upa','','trim'),
            'u_email'       =>      $this->request->post('uemail','','trim'),
            'u_tel'         =>      $this->request->post('utel','','trim'),
        ];
       
        // }

        // 执行注册
        $re = app('db')->table('chenky_zhengcx_user')->insert($data);
        // 判断结果
        if ($re == 1) {
            #发帖成功
            $this -> success('注册成功','user/login');
        }else {
            #发帖失败
            $this -> error('注册失败');
        }
    }

    /**
     * 修改密码
     */
    public function doChange()
    {
        // 判断是否已经登录
        $this->check();
        // 修改密码
        $re = app('db')->table('chenky_zhengcx_user')
            ->where('u_nick','chenky')
            ->where('u_pa',md5('123456'))
            ->update(['u_pa' => md5('sz123456')]);
        if ($re == 1) {
            #修改成功
            $this -> success('修改成功,请重新登录!','user/logout');
        }else {
            #修改失败
            $this -> error('修改失败!','user/changePa');
        }
    }
    
    public function changePa()
    {
        $this->check();
        return app('view')->fetch();
    }

    /*
     *渲染上传头像的表单页面
    */
    function me()
    {
        $this->check();
        return app('view')->fetch();
    }

    public function upMe()
    {
        // 查票
        $this->check();
        try {
            validate(get_class(app('fc')))
            ->scene('upme')
            ->check([
                'upload'  =>  app('request')->file('uimg'),
            ]);
        } catch (ValidateException $e) {
            //throw $th;
           $this->error('错误：'.$e->getError());
        }
        // 获取文件对象
        $file = $this->request->file('uimg');
        // dump($file);
        $savename = app('filesystem')->disk('uimg')->putFile('',$file);
        // dump($val);
        $fileName = $this->app->getRootPath() . 'public/static/chenky_zhengcx_forum/uimg/' . $savename;
        // 判断文件是否存在
        if (!file_exists($fileName)) {
            $this->error('文件上传失败，请稍后重试！');
        }
        // 更新头像
        $re = app('db')->table('chenky_zhengcx_user')
                ->where('u_nick',app('session')->get('uNick'))
                ->update(['u_img' => $savename]);
        // 判断更新结果
        if ($re == 1) {
            # 更新成功，删除旧文件，修改cookie值，提示，跳转
            // 如果不是默认头像，就删除头像
                $oldFile = $this->app->getRootPath() . 'public/static/chenky_zhengcx_forum/uimg/' . app('cookie')->get('uImg');
                unlink($oldFile);
                app('cookie')->set('uImg',$savename);
                $this->success('头像更新成功！','index/index');
        } else{
            # 更新失败,删除新头像，提示，跳转
            unlink($fileName);
            $this->error('头像更新失败！','user/me');
        }
    }
}
