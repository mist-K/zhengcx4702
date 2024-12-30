<?php
// 2203010201+2203010247
namespace app\chenky_zhengcx_forum\controller;

class Forum
{
    const FORUMNAME = 'TP论坛';
    public $debug;
    /* 
    * 构造方法，初始化变量debug的值
    */
    public function __construct()
    {
        $this->debug = true;
    }
    /* 
    * 打印当前的调试模式的值
    */
    public function showDebug()
    {
        dump($this->debug);
    }
    /* 
    * 返回当前论坛的名字
    */
    public static function showName()
    {
        return self::FORUMNAME;
    }
}