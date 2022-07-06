-- Adminer 4.3.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `assessments`;
CREATE TABLE `assessments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cost` varchar(50) NOT NULL,
  `attachment_needed` tinyint(4) NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `assessments` (`id`, `name`, `type`, `description`, `cost`, `attachment_needed`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	'online',	'type',	'desc ',	'11',	0,	'1',	0,	'2017-04-09 19:11:31',	'2017-04-09 19:27:05'),
(2,	'new',	'type',	'test desc',	'123456',	1,	'1',	0,	'2017-04-09 19:29:36',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vacancy` varchar(200) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `verification` varchar(200) NOT NULL,
  `assessment_requested_date` datetime NOT NULL,
  `estimated_completion_date` datetime NOT NULL,
  `cost` int(11) NOT NULL,
  `report` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `booking_recieved` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `family` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `cost` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `jobs` (`id`, `title`, `family`, `description`, `cost`, `status`, `is_deleted`, `created_date`, `modified_date`) VALUES
(1,	'test 1 ',	'test 1',	'test test',	'12.34',	'1',	0,	'2017-04-09 19:02:43',	'2017-04-09 19:09:19'),
(2,	'test',	'test',	'test',	'12345678',	'1',	0,	'2017-04-09 19:02:51',	'2017-04-09 19:25:37');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` enum('ADMIN','CLIENT','CANDIDATE') NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `client_company` varchar(200) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `division` varchar(100) NOT NULL,
  `cost_center_number` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `is_verified` int(11) NOT NULL,
  `is_forget_password` int(11) NOT NULL,
  `is_approve` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `user_role`, `firstname`, `middlename`, `lastname`, `fullname`, `client_company`, `id_number`, `mobile`, `telephone`, `email`, `username`, `password`, `phone`, `job_title`, `company`, `business_unit`, `division`, `cost_center_number`, `created_date`, `modified_date`, `is_verified`, `is_forget_password`, `is_approve`, `status`, `is_delete`) VALUES
(1,	'ADMIN',	'Meenesh',	'',	'Jain',	'',	'',	'',	'+919993755651',	'',	'j.meenesh@gmail.com',	'admin',	'202cb962ac59075b964b07152d234b70',	'9993755651',	'',	'MjTechno',	'',	'',	0,	'2017-04-04 23:06:26',	'2017-04-04 23:06:26',	1,	0,	1,	1,	0),
(2,	'CLIENT',	'rocky',	'',	'chester',	'',	'',	'1234567890',	'0987654321',	'0987654321',	'developer@mailinator.com',	'developer',	'202cb962ac59075b964b07152d234b70',	'',	'developer',	'rockstar group',	'games',	'india',	123456789,	'2017-04-07 00:21:21',	'0000-00-00 00:00:00',	0,	0,	0,	1,	0),
(3,	'CANDIDATE',	'test',	'',	'test',	'',	'',	'test',	'test',	'test',	'developer1@mailinator.com',	'developer1',	'f2bfd884ed624f50ffa32062dfa2060e',	'',	'test',	'test',	'test',	'test',	0,	'2017-04-07 00:27:10',	'0000-00-00 00:00:00',	0,	0,	0,	1,	0),
(4,	'CLIENT',	'new',	'',	'test',	'',	'',	'system123',	'123456789',	'123456789',	'develooper@mailinator.com',	'develooper',	'a538a2872163400b477af1a9e409c5e3',	'',	'developer',	'test company',	'test',	'test',	0,	'2017-04-08 16:51:36',	'0000-00-00 00:00:00',	0,	0,	0,	1,	0),
(5,	'CLIENT',	'developer',	'',	'two',	'',	'',	'12345678',	'1234567',	'1234567',	'developertwo@mailinator.com',	'developer12',	'bbb4fc941786d2a2e88c34a7a0251f18',	'',	'developer',	'developer',	'developer',	'developer',	0,	'2017-04-09 16:42:00',	'0000-00-00 00:00:00',	0,	0,	0,	1,	0),
(6,	'CLIENT',	'',	'',	'',	'meenesh',	'fxbytes',	'12345',	'23456',	'12345',	'developer123@gmail.cp,',	'dev123',	'b9ba08ada0d2da948f2cdbb1968bd212',	'',	'developer',	'fxbytes',	'test',	'software',	123,	'2017-04-14 22:55:06',	'0000-00-00 00:00:00',	0,	0,	0,	1,	0);

DROP TABLE IF EXISTS `vacancy`;
CREATE TABLE `vacancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vacancy_name` varchar(200) NOT NULL,
  `vacancy_description` varchar(250) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-04-14 19:19:40
