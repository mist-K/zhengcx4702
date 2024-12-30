-- 2203010201+2203010247
-- 创建数据库
create database chenky_zhengcx_forum
    default charset utf8
    collate utf8_general_ci;

-- 进入数据库
use chenky_zhengcx_forum

-- 创建用户表
drop table if exists chenky_zhengcx_user;
create table chenky_zhengcx_user
    (
        u_nick varchar(10) primary key not null,
        u_pa char(32),
        u_email varchar(30),
        u_tel bigint(11) unsigned,
        u_img char(41) default 'user.jpg'
    )engine = innodb default charset utf8;
-- 调整user表结构
alter table chenky_zhengcx_user modify u_img varchar(46) default 'user.jpg';

-- 创建板块表
drop table if exists chenky_zhengcx_section;
create table chenky_zhengcx_section
    (
        s_id int auto_increment primary key,
        s_name varchar(20),
        s_remark varchar(50)
    )engine = innodb default charset utf8;
-- 创建帖子表
drop table if exists chenky_zhengcx_mes;
create table chenky_zhengcx_mes
    (
        m_id int auto_increment primary key,
        m_title varchar(30),
        m_content text,
        m_unick varchar(10),
        m_createat timestamp default current_timestamp,
        m_sid int
    )engine = innodb default charset utf8;
-- 创建回复表
drop table if exists chenky_zhengcx_res;
create table chenky_zhengcx_res
    (
        r_id int auto_increment primary key,
        r_content text,
        r_unick varchar(10),
        r_createat timestamp default current_timestamp,
        r_mid int
    )engine = innodb default charset utf8;
-- 创建用户
create user 'chenky_zhengcx'@localhost
    identified by '87654321';

-- 授权
grant select,update,insert
    on chenky_zhengcx_forum.*
    to 'chenky_zhengcx'@localhost;

-- 创建用户
create user 'chenky_'@localhost
    identified by '12345678';

-- 授权
grant select,update,insert
    on chenky_zhengcx_forum.*
    to 'chenky_'@localhost;

-- 创建用户    
create user 'zhengcx_'@localhost
    identified by '123456789';

-- 授权
grant select,update,insert
    on chenky_zhengcx_forum.*
    to 'zhengcx_'@localhost;






