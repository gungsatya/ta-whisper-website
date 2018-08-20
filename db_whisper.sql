/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.34-MariaDB : Database - db_whisper
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_whisper` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_whisper`;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surename` varchar(50) DEFAULT NULL,
  `privilege` enum('administrator','operator') NOT NULL DEFAULT 'operator',
  `category` enum('all','infra','adm','kes','pend','lainnya') NOT NULL DEFAULT 'all',
  `user_identifier` varchar(50) DEFAULT NULL,
  `password` char(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `answer_text_option` */

DROP TABLE IF EXISTS `answer_text_option`;

CREATE TABLE `answer_text_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param_in_id` int(11) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `val` varchar(100) DEFAULT NULL,
  `markup_type` enum('text','contact','location') DEFAULT 'text',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `command` */

DROP TABLE IF EXISTS `command`;

CREATE TABLE `command` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `operation_id` int(11) DEFAULT NULL,
  `chat_id` bigint(20) DEFAULT NULL,
  `sql_query` text,
  `flag` enum('ready','processed') DEFAULT 'ready',
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

/*Table structure for table `discussion` */

DROP TABLE IF EXISTS `discussion`;

CREATE TABLE `discussion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `sender_name` varchar(50) DEFAULT NULL,
  `privilege` enum('user','operator','administrator') DEFAULT NULL,
  `content` longtext,
  `chat_id` bigint(20) DEFAULT NULL,
  `message_id` bigint(20) DEFAULT NULL,
  `report_token` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Table structure for table `error_message` */

DROP TABLE IF EXISTS `error_message`;

CREATE TABLE `error_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `message_in` */

DROP TABLE IF EXISTS `message_in`;

CREATE TABLE `message_in` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) DEFAULT NULL,
  `update_id` bigint(20) DEFAULT NULL,
  `message_id` bigint(20) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `surename` varchar(100) DEFAULT NULL,
  `content_type` enum('location','text','photo') DEFAULT NULL,
  `content` text,
  `flag` enum('just_arrived','read','processed') DEFAULT 'just_arrived',
  `received_at` datetime(3) DEFAULT NULL,
  `last_updated_at` timestamp(3) NULL DEFAULT CURRENT_TIMESTAMP(3) ON UPDATE CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=latin1;

/*Table structure for table `message_out` */

DROP TABLE IF EXISTS `message_out`;

CREATE TABLE `message_out` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) DEFAULT NULL,
  `is_reply` tinyint(1) DEFAULT '0',
  `reply_message_id` bigint(20) DEFAULT NULL,
  `content_type` enum('text','location','photo') DEFAULT NULL,
  `content` text,
  `is_replymarkup` tinyint(1) DEFAULT '0',
  `reply_markup` text,
  `caption` varchar(25) DEFAULT '""',
  `flag` enum('ready','packed','sent') DEFAULT 'ready',
  `created_at` datetime(3) DEFAULT NULL,
  `sent_at` datetime(3) DEFAULT NULL,
  `last_updated_at` timestamp(3) NULL DEFAULT CURRENT_TIMESTAMP(3) ON UPDATE CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=474 DEFAULT CHARSET=latin1;

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_url` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `url_img` varchar(100) DEFAULT NULL,
  `banner_img` varchar(100) DEFAULT NULL,
  `content` longtext,
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `news_broadcast` */

DROP TABLE IF EXISTS `news_broadcast`;

CREATE TABLE `news_broadcast` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `is_broadcasted` tinyint(1) NOT NULL DEFAULT '0',
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

/*Table structure for table `operation` */

DROP TABLE IF EXISTS `operation`;

CREATE TABLE `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_syntax` varchar(50) DEFAULT NULL,
  `explain` text,
  `is_sql_command` tinyint(1) DEFAULT '0',
  `is_read_command` tinyint(1) DEFAULT '0',
  `in_sql` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `param_in` */

DROP TABLE IF EXISTS `param_in`;

CREATE TABLE `param_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_id` int(11) DEFAULT NULL,
  `param_in_order` tinyint(4) DEFAULT NULL,
  `param_in` varchar(50) DEFAULT NULL,
  `question` text,
  `question_type` enum('open','close') DEFAULT NULL,
  `answer_type` enum('text','location','photo') DEFAULT NULL,
  `is_restricted` tinyint(1) DEFAULT '0',
  `is_long_answer` tinyint(1) DEFAULT '0',
  `require_param` text,
  `is_buffer_value` tinyint(1) DEFAULT '0',
  `default_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `param_out` */

DROP TABLE IF EXISTS `param_out`;

CREATE TABLE `param_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_id` bigint(20) DEFAULT NULL,
  `response` text,
  `response_type` enum('text','photo','location') DEFAULT 'text',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `pattern` */

DROP TABLE IF EXISTS `pattern`;

CREATE TABLE `pattern` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `flag` enum('creating','drop','finish') DEFAULT 'creating',
  `created_at` datetime(3) NOT NULL,
  `last_updated_at` timestamp(3) NULL DEFAULT CURRENT_TIMESTAMP(3) ON UPDATE CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

/*Table structure for table `pattern_control` */

DROP TABLE IF EXISTS `pattern_control`;

CREATE TABLE `pattern_control` (
  `chat_id` bigint(20) NOT NULL,
  `is_subscribed` tinyint(1) NOT NULL DEFAULT '1',
  `current_processed` enum('idle','discussion','operation','tmp_survey','survey') NOT NULL DEFAULT 'idle',
  `current_ops_id` int(11) DEFAULT NULL,
  `current_param_in_id` int(11) DEFAULT NULL,
  `current_pattern_id` bigint(20) DEFAULT NULL,
  `current_pattern_param_id` bigint(20) DEFAULT NULL,
  `temp_survey_id` int(11) DEFAULT NULL,
  `current_survey_id` int(11) DEFAULT NULL,
  `current_survey_question_id` bigint(20) DEFAULT NULL,
  `current_report_discussion_token` varchar(20) DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `pattern_param` */

DROP TABLE IF EXISTS `pattern_param`;

CREATE TABLE `pattern_param` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pattern_id` bigint(20) DEFAULT NULL,
  `message_in_id` bigint(20) DEFAULT NULL,
  `param` varchar(50) DEFAULT NULL,
  `param_value` text,
  `created_at` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `msg_in_id` (`message_in_id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1;

/*Table structure for table `problem_report` */

DROP TABLE IF EXISTS `problem_report`;

CREATE TABLE `problem_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `token` varchar(15) DEFAULT NULL,
  `chat_id` bigint(20) DEFAULT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `status` enum('terdaftar','didiskusikan','agenda rapat','dilaksanakan','ditolak','selesai') NOT NULL DEFAULT 'terdaftar',
  `content` text,
  `location` varchar(50) DEFAULT NULL,
  `is_replied` tinyint(4) DEFAULT '0',
  `is_file` tinyint(1) DEFAULT '0',
  `file_name` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Table structure for table `survey` */

DROP TABLE IF EXISTS `survey`;

CREATE TABLE `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `explanation` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `due_at` datetime DEFAULT NULL,
  `last_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `survey_broadcast` */

DROP TABLE IF EXISTS `survey_broadcast`;

CREATE TABLE `survey_broadcast` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `is_broadcasted` tinyint(1) NOT NULL DEFAULT '0',
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

/*Table structure for table `survey_question` */

DROP TABLE IF EXISTS `survey_question`;

CREATE TABLE `survey_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `question` varchar(200) DEFAULT NULL,
  `is_closed` tinyint(1) DEFAULT NULL,
  `answers` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `survey_respond` */

DROP TABLE IF EXISTS `survey_respond`;

CREATE TABLE `survey_respond` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) DEFAULT NULL,
  `survey_question_id` bigint(20) DEFAULT NULL,
  `chat_id` bigint(20) DEFAULT NULL,
  `respond` varchar(100) DEFAULT NULL,
  `created_at` timestamp(3) NULL DEFAULT CURRENT_TIMESTAMP(3) ON UPDATE CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/* Trigger structure for table `message_in` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_msg_in_old` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `insert_msg_in_old` BEFORE INSERT ON `message_in` FOR EACH ROW insert into citizenl_whisper.msg_in(
    chat_id, 
    username, 
    surename, 
    content_type,
    content
)
VALUES(
	new.chat_id,
    new.username,
    new.surename,
    new.content_type,
    new.content
) */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
