-- 进入数据库
use chenky_zhengcx_forum

-- 添加测试记录
insert into chenky_zhengcx_user
    (u_nick,u_pa,u_email,u_tel)
    values
    ('chenky',md5('123456'),'chenky@sziit.edu.cn','13828198231'),
    ('zhengcx',md5('123456'),'zhengcx@sziit.edu.cn','13299290337');

insert into chenky_zhengcx_mes
    (m_title,m_content,m_unick,m_sid)
    values
    ('标题02','新帖子02内容','chenky',1),
    ('标题03','新帖子03内容','tom',2),
    ('标题04','新帖子04内容','tom',3),
    ('标题05','新帖子05内容','zhengcx',4),
    ('标题06','新帖子06内容','tom',1),
    ('NULL','反馈建议1','zhengcx',5);

insert into chenky_zhengcx_mes
    (m_content,m_unick,m_sid)
    values
    ('产品分享1','chenky',5),
    ('社区反馈建议','zhengcx',5);
    ('标题07','新帖子02内容','chenky',1),
    ('标题08','新帖子03内容','tom',2),
    ('标题09','新帖子04内容','tom',3),
    ('标题10','新帖子05内容','zhengcx',4);

insert into chenky_zhengcx_section
    (s_name,s_remark)
    values
    ('我找到一个BUG','我找到一个BUG'),
    ('我有一个想法','我有一个想法'),
    ('我有产品要分享','我有产品要分享'),
    ('这个扩展很奈斯','这个扩展很奈斯'),
    ('社区反馈建议','社区反馈建议');

insert into chenky_zhengcx_res
    (r_content,r_unick,r_mid)
    values
    ('帖子1的回复内容','chenky',2),
    ('帖子2的回复内容','zhengcx',2),
    ('帖子3的回复内容','chenky',2);
    ('新帖子03的回复1','tom',2),
    ('新帖子02的回复2','zhengcx',1),
    ('新帖子02的回复3','tom',1),
    ('新帖子02的回复4','zhengcx',1);

