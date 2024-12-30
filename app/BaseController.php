<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Session;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    use \liliuwei\think\Jump; 
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, string|array $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    protected function listSec($sid = 0)
    {
        // 获取所有的板块
        $sec = Db::table('chenky_zhengcx_section');
        // 当sid的值不为0的时候，加入筛选条件
        if ($sid > 0) {
            # 查询指定的版块
            $sec = $sec -> where('s_id',$sid);
        }
        $sec = $sec -> column('s_id,s_name');
        // dump($sec);

        // 统计版块的发帖数量
        foreach($sec as &$section)
        {
            $section['count'] = Db::table('chenky_zhengcx_mes')->where('m_sid',$section['s_id'])->count();
        }

        return $sec;
    }
    /*
    测试继承定义的方法
    */
    public function testPublic()
    {
        dump('这是基类的公开方法打印的信息');
    }
    /*
    测试继承定义的方法
    */
    public function testProtected()
    {
        dump('这是基类的受保护方法打印的信息');
    }
    /*
    测试继承定义的方法
    */
    public function testPrivate()
    {
        dump('这是基类的私有方法打印的信息');
    }
    // 静态资源
    public static $school = 'sziit';
    const SCHOOL = '深圳信息';
    /*
    测试继承定义的方法
    */
    public static function testStatic()
    {
        dump('这是基类的受保护静态方法打印的信息');
    }


    /**
     * 防范匿名访问
     */
    protected function check()
    {
        if (!Session::has('uNick')) {
            # 如果变量uInfo不存在，代表未登录，跳转到登录页面
            $this->error('请登录后再访问本功能!','user/login');
        }
    }
}
