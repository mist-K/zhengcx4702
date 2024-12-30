<?php
declare (strict_types = 1);

namespace app\chenky_zhengcx_forum\controller;

use think\Model;

/**
 * 
 */
class Mes extends Model
{
    // 主键
    protected $pk = 'm_id';
    protected $connection = 'forum_r';
    // 说明数据表的字段名及类型
    protected $schema = [
        'm_id'          =>          'int',
        'm_title'       =>          'string',
        'm_content'     =>          'string',
        'm_unick'       =>          'string',
        'm_createat'    =>          'datetime',
        'm_sid'         =>          'int'
    ]; 

    function setConn($conn)
    {
        $this->connection = $conn;
    }

}