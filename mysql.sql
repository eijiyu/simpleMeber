CREATE TABLE `user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_first_name` varchar(255) NOT NULL COMMENT 'first name',
  `user_last_name` varchar(255) NOT NULL COMMENT 'last name',
  `user_sex` enum('男','女') NOT NULL COMMENT 'sex',
  `user_adress` varchar(255) NOT NULL COMMENT 'address',
  `user_mail` varchar(255) NOT NULL COMMENT 'email',
  `user_phone` char(10) NOT NULL COMMENT 'phone',
  `user_birth` date NOT NULL COMMENT 'DOB',
  `user_pro` varchar(255) NOT NULL COMMENT 'Pro file',
  `user_intro` text NOT NULL COMMENT 'instroduce',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;