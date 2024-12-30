<?php
declare (strict_types = 1);

namespace app\chenky_zhengcx_forum\controller;

use think\Model;

/**
 * 
 */
class Section extends Model
{
    //主键名
    protected $pk = 's_id';
    // 模型字段和类型
    protected $schema = [
        's_id'      =>      'int',
        's_name'    =>      'string',
        's_remark'  =>      'string',
        's_img'     =>      'string',
    ];
}