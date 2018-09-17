CREATE TABLE `user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '身分序號',
  `user_name` varchar(255) NOT NULL COMMENT '姓名',
  `user_sex` enum('男','女') NOT NULL COMMENT '性別',
  `user_adress` varchar(255) NOT NULL COMMENT '地址',
  `user_mail` varchar(255) NOT NULL COMMENT '電子郵件',
  `user_phone` char(10) NOT NULL COMMENT '手機',
  `user_tel` varchar(255) NOT NULL COMMENT '電話',
  `user_birth` date NOT NULL COMMENT '生日',
  `user_pro` varchar(255) NOT NULL COMMENT '職業與職位',
  `user_intro` text NOT NULL COMMENT '客戶簡介',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;