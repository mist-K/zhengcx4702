<?php
declare(static_types = 1);
// 2203010201+2203010247
namespace app\chenky_zhengcx_forum\controller;

use app\BaseController;
use think\console\command\optimize\Route;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Env;
use think\facade\Session;
use think\facade\View;
use think\Session as ThinkSession;

class Index extends BaseController
{
    public function contact()
    {
        return View::fetch('index/contact');
    }

    public function detail(int $mid)
    {
        try {
            validate(app('fc')::class)
            ->scene('mid')
            ->check([
                'mid' => $mid
            ]);
        } catch (ValidateException $e) {
            //throw $th;
            halt($e->getError());
        }
        // 查询指定帖子（第一个帖子）的详细信息
        $mes = Db::view('chenky_zhengcx_mes','m_id,m_title,m_content,m_unick,m_createat')
        ->view('chenky_zhengcx_user','u_img','m_unick = u_nick')
        ->view('chenky_zhengcx_section','s_name','m_sid = s_id','right')
        ->where('m_id',$mid)
        ->order('m_createat','desc')
        ->find();
        dump($mes);
        // 查询第一个帖子的所有回复的详细信息
        $res = Db::view('chenky_zhengcx_res','r_unick,r_content,r_createat')
        ->view('chenky_zhengcx_user','u_nick,u_img','u_nick = r_unick')
        ->where('r_mid',$mid)
        ->order('r_createat','desc')
        // ->select();
        ->paginate(1);
        dump($res);
        $page = $res->render();
        $sum = $res->total();
        $num = count($res);

        return View::fetch('',['mes'=>$mes,'res'=>$res,'num'=>$num,'page'=>$page,'sum'=>$sum]);
    }


        /* 
    * 回复执行
    * 
    */
    public function doDetail(int $mid)
    {
        // 查票，防止匿名访问
        $this->check();
        // 提取帖子的信息
        $rCon = $this->request->post('rcontent','','htmlspecialchars');
        // 组织数组
        $data = [
            'r_content'     =>      $rCon,
            'r_unick'       =>      Session::get('uNick'),
            'r_mid'         =>      $mid,
        ];
        $res = Db::table('chenky_zhengcx_res')->insert($data);
        // 判断结果，跳转
        if ($res == 1) {
            # 回复成功
            $this->success('回复成功！','index/detail');
        } else{
            #回复失败
            $this->error('回复失败！');
        }
    }
    public function index()
    {
        return View::fetch('index/index');
    }

    public function post()
    {
        // 查票
        $this->check();
        // 查询所有的板块
        $re = Db::table('chenky_zhengcx_section')->column('s_id,s_name','s_id');
        dump($re);
        return View::fetch('',['sec'=>$re]);
    }


    public function view(int $sid = 0)
    {
        // 查询制定板块或话题（第一个板块）的所有帖子
        $mes = Db::view('chenky_zhengcx_mes','m_id,m_title,m_unick,m_content,m_createat')
        ->view('chenky_zhengcx_user','u_img','m_unick = u_nick')
        ->view('chenky_zhengcx_section','s_name','m_sid = s_id');
        if ($sid > 0) {
            # 查询制定板块
            $mes = $mes->where('s_id',$sid);
        }
        
        
        $mes = $mes->order('m_createat','desc')
        ->paginate(1);
        $page = $mes->render();
        $sum = $mes->total();
        dump($mes);

        return View::fetch('',['mes'=>$mes,'page'=>$page,'sum'=>$sum]);
    }

    /**
     * 执行发帖的操作
     */
    function doPost()
    {
        $this->check();
        // 组织数组
        $data = [
            // 'm_title'       =>      $this->request->post('mtitle','','htmlspecialchars'),
            'm_content'     =>      $this->request->post('mcontent',''),
            'm_unick'       =>      session('uNick'),
            'm_sid'         =>      $this->request->post('msid/d'),
        ];

        // 执行链式查询
        $mes = Db::table('chenky_zhengcx_mes')->insert($data);

        // 判断结果
        if ($mes == 1) {
            # 发帖成功
            $this->success('发帖成功',(string)url('index/view',['sid'=>input('msid')]));
        } else {
            # 发帖失败
            $this->error('发帖失败','index/post');
        }
    }

    public function doRes(int $mid)
    {
        // 查票，防止匿名访问
        $this->check();

        // 组织数组
        $data = [
            'r_content'     =>      $this->request->post('rcontent','','htmlspecialchars'),
            'r_unick'       =>      session('uNick'),
            'r_mid'         =>      $mid,
        ];
        $res = Db::table('chenky_zhengcx_res')->insert($data);
        // 判断结果，跳转
        if ($res == 1) {
            # 回复成功
            $this->success('回复成功！');
        } else{
            #回复失败
            $this->error('回复失败！');
        }
    }

    /*
    测试在结构体外部访问类的资源
    */
    public function testAccessIndex()
    {
        // 使用非限定名称访问Test，使用当前类的命名空间前缀
        // (new Test)->testPublic();
        // (new Test())->testStatic();
        // app\chenky_zhengcx_forum\controller\Test0
        // Test0::testStatic();
        // 限定名称访问类,把当前类的命名空间前缀复制到该类
        // think\Test::testStatic();
        // 完全限定,以\开头的命名空间
        // think\facade\Test
        // \think\facade\Test::testStatic();

    }


}
