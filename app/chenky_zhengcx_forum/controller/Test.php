<?php
declare (strict_types = 1);
// 2203010201+2203010247
namespace app\chenky_zhengcx_forum\controller;

use app\BaseController;
use think\facade\Config;
use think\facade\Db;
use think\facade\Env;
use think\facade\Route;
use think\facade\Session;
use think\facade\View;
use think\Request;

class Test extends BaseController
{
    /*
    * 变量输出 
    */
    function printParam()
    {
        // 系统变量
        dump($this->request->post('id'));
        // http://localhost:8080/zhengcx47/public/chenky_zhengcx_forum/test/printparam?id=345
        dump($this->request->get('id'));
        // 路由变量
        http://localhost:8080/zhengcx47/public/chenky_zhengcx_forum/test/printparam/id/345
        dump($this->request->route('id'));
        // 通用方法：param
        dump($this->request->param('id'));
        // 超全局变量：SERVER、ENV、Session、Cookie
        dump($this->request->session('uInfo'));
        dump($this->request->cookie('uImg'));
        dump($this->request->server());
        dump($this->request->server('SERVER_PORT'));
        
        // 普通变量
        $name = 'zhangs';
        $re = Db::table('chenky_zhengcx_user')->column('u_nick');
        dump($name);
        dump($re);

        return View::fetch('',['tplName' => $name , 'tplRe' => $re]);

    }


    // 属性的定义
    public $public;
    /*
    * 测试类的访问控制、继承等
    */
    public function showParent()
    {
        // echo $this->public;
        // $this->showConfig();
        // 访问基类的属性
        dump($this->app);
        dump($this->request);
        /*
        * 非静态的方法访问控制
        * public 随便访问，默认
        * protected 可被继承，但仅在结构体内部访问
        * private 不可被继承
        */
        // $this->testPublic();
        // $this->testProtected();
        // $this->testPrivate();
        // 访问静态资源
        // dump(self::$school);
        // dump(self::SCHOOL);
        self::testStatic();
        parent::testStatic();
        dump(Env::get('FORUM_DB_R.DB_NAME'));
        dump(Env::get('FORUM_DB_R.DB_USER'));
    }
    /**
     * 检查全局配置、应用配置和批量配置的实施和优先级排列问题
     *
     * 
     */
    // 2203010201+2203010247
    public function showConfig()
    {
        //全局和应用配置优先级问题
        echo('前台的数据库配置文件内容为：');
        $config = Config::get('database');
        dump($config);
        $config1 = Config::get('database.default');
        echo('前台的默认数据库连接方案是：'),$config1;
        echo "</br>";
        $config2 = Config::get('database.connections.forum_r.username');
        echo('默认使用的数据库用户是：'),$config2;
        /*
        结论：批量配置仅在配置命令生效后才起作用，直到同一个配置再次实施批量配置，或是方法结束为止
        */
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }
    
    /**
     * url生成
     * 
     */
    public function createUrl()
    {
        // 生成去往User/test的url
        dump(Route::buildUrl('user/test'));
        // /zhengcx47/public/chenky_zhengcx_forum/user/test.html
        echo(Route::buildUrl('user/test'));
        // http://localhost:8080/zhengcx47/public/chenky_zhengcx_forum/user/test.php
        echo(Route::buildUrl('user/test')
        ->domain(true)
        ->suffix('php'));
        // /zhengcx47/public/chenky_zhengcx_forum/user/test.html?id=4567&name=zhangs
        // 配置'url_common_param'      => false,
        // /zhengcx47/public/chenky_zhengcx_forum/user/test/id/4567/name/zhangs.html
        // 路由定义后可能的url
        // /zhengcx47/public/chenky_zhengcx_forum/user/test/4567/zhangs.html
        echo(Route::buildUrl('user/test',['id'=> 4567 , 'name' => 'zhangs']));
    }

    /**
     * 操作会话
     * 
     */
    public function dealSession()
    {
        // 注册会话变量
        Session::set('name','张三');
        // 存储位置：文件sess_81573417d6c14ee08fdaaf62815ee3e1
        // UID：81573417d6c14ee08fdaaf62815ee3e1
        // UID如何传递，通过cookie
        dump(Session::get('name'));
        dump(session('name'));
        // 判断变量是否存在
        dump(Session::has('name'));
        dump(session('?name0'));
        // 如果变量x不存在，代表未登录，跳转到登录页面
        Session::delete('name');
        if (!Session::has('x')) {
            # code...
            $this->error('请登录后再访问本功能!','user/login');
        }
        // 反注册会话变量
    }

    /**
     * 查询数据
     * 
     */
    public function selectData()
    {
        // 值查询
        // field+find
        // 仅适用于查询一条记录的一个字段的场景
        $re = Db::table('chenky_zhengcx_user')->value('u_nick');
        // $re = Db::name('user')->where('u_nick')->find();
        // 列查询，查询符合条件的所有记录的某些列的值
        // 可以设置结果记录的索引
        // 相当于field+select
        // 返回数组，查不到返回[]
        // $re = Db::name('user')
        // // ->where('u_nick','zhangs')
        // ->column('u_tel,u_img','u_nick');
        // dump($re['chenky']['u_tel']);
        // dump($re['zhengcx']['u_tel']);
        // 游标查询
        // 优点：在海量数据查询时，可以减少内存消耗
        // 返回Generator对象
        $re = Db::table('chenky_zhengcx_user')->cursor();
        $re = Db::table('chenky_zhengcx_user')->select();
        foreach ($re as $row) {
            # code...
            // dump($key);
            dump($row);
            dump($row['u_email']);
            dump($row['u_tel']);
        }

        // 视图查询
        // 返回query对象
        // view方法的第三个参数要给出两个表的约束条件，否则会报错：字段不存在
        // 默认时inner join的记录合并
        $re = Db::view('chenky_zhengcx_mes','m_title,m_content,m_createat')
        // view的第四个参数：left，代表当前表不重要，尽量查，查不到就算了
        // view的第四个参数：right，代表当前表很重要，一定要查，其他表尽量查
        ->view('chenky_zhengcx_user','u_nick,u_img','m_unick = u_nick')
        ->select();
        
        dump($re);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * 使用容器访问类
     */
    function useApp()
    {
        // 认识容器
        dump($this->app);
        // 通过容器访问类
        // 返回think\Db对象
        dump($this->app->db);
        dump($this->app['db']);
        dump(app('db'));
        $re = app('db')->name('user')->select();
        dump($re);
        // 
        dump(app('test'));

    }
    /**
     * 通过模型访问数据库
     */
    function useModel()
    {
        // 获取主键为1的帖子
        $re = app('mes')->find(1);
        dump($re);
        dump($re->m_id);
        dump($re->m_title);

        // 获取多条数据记录
        $re = app('mes')->select([1,2,3]);
        dump($re);
        foreach ($re as $key => $value) {
            # code...
            dump($value->m_id);
            dump($value->m_title);
            dump($value->m_createat);
        }

        // 更新
        $re = app('mes')->setconn('forum_ru');
        $re->m_title = '标题';
        $re->save();

    }
}
