<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class FormCheck extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'unick|昵称'            =>      'require|length:2,16|chsDash',
        'upwd|密码'             =>      'require|length:6,16',
        'upwd2|密码确认'        =>      'require|confirm:pwd',
        'uemail|邮箱地址'       =>      'require|email',
        'utel|电话号码'         =>      'require|mobile',
        'ucode|验证码'          =>      'require|captcha',
        'islog|登录状态'        =>      'require',
        'mid|帖子ID'            =>      'checkId:1',
        'sid|帖子ID'            =>      'checkId:2',
        'upload|上传文件'       =>      'require|image|fileExt:png,jpg,gif|fileSize:12111100'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'unick.length'       =>      '昵称的长度限制是2~16个字符,只能是汉字、字母、数字、下划线和破折号组成',
        'upwd.length'        =>      '密码的长度不符合6~16个字符',
        'upwd2.length'       =>      '密码和确认字段不一致',
        'uemail'             =>      '邮箱地址的格式不符',
        'utel'               =>      '手机号码的格式不符',
        'ucode'              =>      '验证码错误',
        'mid'                =>      '你访问的Mid地址不存在',
        'sid'                =>      '你访问的Sid地址不存在',
        'islog'              =>      '请先登录再访问',
        'upload.require'     =>      '不能上传空文件',
        'upload.fileExt'     =>      '文件格式不正确',
        'upload.fileSzie'    =>      '文件大小超过了100KB'
    ];
       /* 
    * 定义验证的场景
    */
    protected $scene = [
        'reg'         =>      ['unick','upwd','upwd2','uemail','utel','ucode'],
        'dologin'     =>      ['unick','upwd','ucode'],
        'msid'        =>      ['mid','sid','islog'],
        'dpsid'       =>      ['islog'],
        'upme'        =>      ['upload'],
        'mid'         =>      ['mid'],
        'log'         =>      ['unick','upwd','ucode','__token__'],
    ];
}
