CREATE TABLE `one_user_score_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `order_money` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '类型:1,系统赠送;2,购物返回',
  `info` char(200) NOT NULL DEFAULT '' COMMENT '详细',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;