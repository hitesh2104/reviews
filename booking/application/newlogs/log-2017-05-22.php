<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

INFO - 2017-05-22 00:00:00 --> Config Class Initialized
INFO - 2017-05-22 00:00:00 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:00:00 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:00:00 --> Utf8 Class Initialized
INFO - 2017-05-22 00:00:00 --> URI Class Initialized
INFO - 2017-05-22 00:00:00 --> Router Class Initialized
INFO - 2017-05-22 00:00:00 --> Output Class Initialized
INFO - 2017-05-22 00:00:00 --> Security Class Initialized
DEBUG - 2017-05-22 00:00:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:00:00 --> Input Class Initialized
INFO - 2017-05-22 00:00:00 --> Language Class Initialized
INFO - 2017-05-22 00:00:00 --> Loader Class Initialized
INFO - 2017-05-22 00:00:00 --> Helper loaded: url_helper
INFO - 2017-05-22 00:00:00 --> Helper loaded: file_helper
INFO - 2017-05-22 00:00:00 --> Helper loaded: common_helper
INFO - 2017-05-22 00:00:00 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:00:00 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:00:00 --> Helper loaded: message_helper
INFO - 2017-05-22 00:00:01 --> Database Driver Class Initialized
INFO - 2017-05-22 00:00:01 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:00:01 --> Helper loaded: form_helper
INFO - 2017-05-22 00:00:01 --> Form Validation Class Initialized
INFO - 2017-05-22 00:00:01 --> Controller Class Initialized
INFO - 2017-05-22 00:00:01 --> Model Class Initialized
INFO - 2017-05-22 00:00:01 --> Model Class Initialized
ERROR - 2017-05-22 00:00:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'as `client_name` LIKE '%developer%' ESCAPE '!'
OR  `jobs`.`title` LIKE '%develop' at line 11 - Invalid query: SELECT SQL_CALC_FOUND_ROWS us.id, us.fullname, us.id_number, us.email, us.telephone, uss.fullname as client_name, jobs.title, us.created_date, us.company, us.is_delete, us.status
FROM `users` as `us`
LEFT JOIN `booking` as `bk` ON `us`.`candidate_booking_id`=`bk`.`id`
LEFT JOIN `users` as `uss` ON `uss`.`id`=`bk`.`client_id`
LEFT JOIN `jobs` ON `jobs`.`id`=`bk`.`job_id`
WHERE `us`.`id` LIKE '%developer%' ESCAPE '!'
OR  `us`.`fullname` LIKE '%developer%' ESCAPE '!'
OR  `us`.`id_number` LIKE '%developer%' ESCAPE '!'
OR  `us`.`email` LIKE '%developer%' ESCAPE '!'
OR  `us`.`telephone` LIKE '%developer%' ESCAPE '!'
OR  `uss`.`fullname` as `client_name` LIKE '%developer%' ESCAPE '!'
OR  `jobs`.`title` LIKE '%developer%' ESCAPE '!'
OR  `us`.`created_date` LIKE '%developer%' ESCAPE '!'
OR  `us`.`company` LIKE '%developer%' ESCAPE '!'
AND `us`.`user_role` = 'CANDIDATE'
AND `us`.`is_delete` = '0'
ORDER BY `us`.`id` DESC
 LIMIT 25
INFO - 2017-05-22 00:00:01 --> Language file loaded: language/english/db_lang.php
INFO - 2017-05-22 00:00:08 --> Config Class Initialized
INFO - 2017-05-22 00:00:08 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:00:08 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:00:08 --> Utf8 Class Initialized
INFO - 2017-05-22 00:00:08 --> URI Class Initialized
INFO - 2017-05-22 00:00:08 --> Router Class Initialized
INFO - 2017-05-22 00:00:08 --> Output Class Initialized
INFO - 2017-05-22 00:00:08 --> Security Class Initialized
DEBUG - 2017-05-22 00:00:08 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:00:08 --> Input Class Initialized
INFO - 2017-05-22 00:00:08 --> Language Class Initialized
INFO - 2017-05-22 00:00:08 --> Loader Class Initialized
INFO - 2017-05-22 00:00:08 --> Helper loaded: url_helper
INFO - 2017-05-22 00:00:08 --> Helper loaded: file_helper
INFO - 2017-05-22 00:00:08 --> Helper loaded: common_helper
INFO - 2017-05-22 00:00:08 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:00:08 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:00:08 --> Helper loaded: message_helper
INFO - 2017-05-22 00:00:08 --> Database Driver Class Initialized
INFO - 2017-05-22 00:00:08 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:00:08 --> Helper loaded: form_helper
INFO - 2017-05-22 00:00:08 --> Form Validation Class Initialized
INFO - 2017-05-22 00:00:08 --> Controller Class Initialized
INFO - 2017-05-22 00:00:08 --> Model Class Initialized
INFO - 2017-05-22 00:00:08 --> Model Class Initialized
ERROR - 2017-05-22 00:00:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'as `client_name` LIKE '%developer%' ESCAPE '!'
OR  `jobs`.`title` LIKE '%develop' at line 11 - Invalid query: SELECT SQL_CALC_FOUND_ROWS us.id, us.fullname, us.id_number, us.email, us.telephone, uss.fullname as client_name, jobs.title, us.created_date, us.company, us.is_delete, us.status
FROM `users` as `us`
LEFT JOIN `booking` as `bk` ON `us`.`candidate_booking_id`=`bk`.`id`
LEFT JOIN `users` as `uss` ON `uss`.`id`=`bk`.`client_id`
LEFT JOIN `jobs` ON `jobs`.`id`=`bk`.`job_id`
WHERE `us`.`id` LIKE '%developer%' ESCAPE '!'
OR  `us`.`fullname` LIKE '%developer%' ESCAPE '!'
OR  `us`.`id_number` LIKE '%developer%' ESCAPE '!'
OR  `us`.`email` LIKE '%developer%' ESCAPE '!'
OR  `us`.`telephone` LIKE '%developer%' ESCAPE '!'
OR  `uss`.`fullname` as `client_name` LIKE '%developer%' ESCAPE '!'
OR  `jobs`.`title` LIKE '%developer%' ESCAPE '!'
OR  `us`.`created_date` LIKE '%developer%' ESCAPE '!'
OR  `us`.`company` LIKE '%developer%' ESCAPE '!'
AND `us`.`user_role` = 'CANDIDATE'
AND `us`.`is_delete` = '0'
ORDER BY `us`.`id` DESC
 LIMIT 25
INFO - 2017-05-22 00:00:08 --> Language file loaded: language/english/db_lang.php
INFO - 2017-05-22 00:00:24 --> Config Class Initialized
INFO - 2017-05-22 00:00:24 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:00:24 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:00:24 --> Utf8 Class Initialized
INFO - 2017-05-22 00:00:24 --> URI Class Initialized
INFO - 2017-05-22 00:00:24 --> Router Class Initialized
INFO - 2017-05-22 00:00:24 --> Output Class Initialized
INFO - 2017-05-22 00:00:24 --> Security Class Initialized
DEBUG - 2017-05-22 00:00:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:00:24 --> Input Class Initialized
INFO - 2017-05-22 00:00:24 --> Language Class Initialized
INFO - 2017-05-22 00:00:24 --> Loader Class Initialized
INFO - 2017-05-22 00:00:24 --> Helper loaded: url_helper
INFO - 2017-05-22 00:00:24 --> Helper loaded: file_helper
INFO - 2017-05-22 00:00:24 --> Helper loaded: common_helper
INFO - 2017-05-22 00:00:24 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:00:24 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:00:24 --> Helper loaded: message_helper
INFO - 2017-05-22 00:00:24 --> Database Driver Class Initialized
INFO - 2017-05-22 00:00:25 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:00:25 --> Helper loaded: form_helper
INFO - 2017-05-22 00:00:25 --> Form Validation Class Initialized
INFO - 2017-05-22 00:00:25 --> Controller Class Initialized
INFO - 2017-05-22 00:00:25 --> Model Class Initialized
INFO - 2017-05-22 00:00:25 --> Model Class Initialized
ERROR - 2017-05-22 00:00:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'as `client_name` LIKE '%developer%' ESCAPE '!'
OR  `jobs`.`title` LIKE '%develop' at line 11 - Invalid query: SELECT SQL_CALC_FOUND_ROWS us.id, us.fullname, us.id_number, us.email, us.telephone, uss.fullname as client_name, jobs.title, us.created_date, us.company, us.is_delete, us.status
FROM `users` as `us`
LEFT JOIN `booking` as `bk` ON `us`.`candidate_booking_id`=`bk`.`id`
LEFT JOIN `users` as `uss` ON `uss`.`id`=`bk`.`client_id`
LEFT JOIN `jobs` ON `jobs`.`id`=`bk`.`job_id`
WHERE `us`.`id` LIKE '%developer%' ESCAPE '!'
OR  `us`.`fullname` LIKE '%developer%' ESCAPE '!'
OR  `us`.`id_number` LIKE '%developer%' ESCAPE '!'
OR  `us`.`email` LIKE '%developer%' ESCAPE '!'
OR  `us`.`telephone` LIKE '%developer%' ESCAPE '!'
OR  `uss`.`fullname` as `client_name` LIKE '%developer%' ESCAPE '!'
OR  `jobs`.`title` LIKE '%developer%' ESCAPE '!'
OR  `us`.`created_date` LIKE '%developer%' ESCAPE '!'
OR  `us`.`company` LIKE '%developer%' ESCAPE '!'
AND `us`.`user_role` = 'CANDIDATE'
AND `us`.`is_delete` = '0'
ORDER BY `us`.`id` DESC
 LIMIT 25
INFO - 2017-05-22 00:00:25 --> Language file loaded: language/english/db_lang.php
INFO - 2017-05-22 00:01:10 --> Config Class Initialized
INFO - 2017-05-22 00:01:10 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:01:10 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:01:10 --> Utf8 Class Initialized
INFO - 2017-05-22 00:01:10 --> URI Class Initialized
INFO - 2017-05-22 00:01:10 --> Router Class Initialized
INFO - 2017-05-22 00:01:10 --> Output Class Initialized
INFO - 2017-05-22 00:01:10 --> Security Class Initialized
DEBUG - 2017-05-22 00:01:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:01:10 --> Input Class Initialized
INFO - 2017-05-22 00:01:10 --> Language Class Initialized
INFO - 2017-05-22 00:01:10 --> Loader Class Initialized
INFO - 2017-05-22 00:01:10 --> Helper loaded: url_helper
INFO - 2017-05-22 00:01:10 --> Helper loaded: file_helper
INFO - 2017-05-22 00:01:10 --> Helper loaded: common_helper
INFO - 2017-05-22 00:01:10 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:01:10 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:01:10 --> Helper loaded: message_helper
INFO - 2017-05-22 00:01:10 --> Database Driver Class Initialized
INFO - 2017-05-22 00:01:10 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:01:10 --> Helper loaded: form_helper
INFO - 2017-05-22 00:01:10 --> Form Validation Class Initialized
INFO - 2017-05-22 00:01:10 --> Controller Class Initialized
INFO - 2017-05-22 00:01:10 --> Model Class Initialized
INFO - 2017-05-22 00:01:10 --> Model Class Initialized
ERROR - 2017-05-22 00:01:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY `us`.`id` DESC
 LIMIT 25' at line 18 - Invalid query: SELECT SQL_CALC_FOUND_ROWS us.id, us.fullname, us.id_number, us.email, us.telephone, uss.fullname as client_name, jobs.title, us.created_date, us.company, us.is_delete, us.status
FROM `users` as `us`
LEFT JOIN `booking` as `bk` ON `us`.`candidate_booking_id`=`bk`.`id`
LEFT JOIN `users` as `uss` ON `uss`.`id`=`bk`.`client_id`
LEFT JOIN `jobs` ON `jobs`.`id`=`bk`.`job_id`
WHERE   (
`us`.`id` = 'developer'
OR `us`.`fullname` = 'developer'
OR `us`.`id_number` = 'developer'
OR `us`.`email` = 'developer'
OR `us`.`telephone` = 'developer'
OR `uss`.`fullname` = 'developer'
OR `jobs`.`title` = 'developer'
OR `us`.`created_date` = 'developer'
OR `us`.`company` = 'developer'
AND `us`.`user_role` = 'CANDIDATE'
AND `us`.`is_delete` = '0'
ORDER BY `us`.`id` DESC
 LIMIT 25
INFO - 2017-05-22 00:01:10 --> Language file loaded: language/english/db_lang.php
INFO - 2017-05-22 00:02:15 --> Config Class Initialized
INFO - 2017-05-22 00:02:15 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:02:15 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:02:15 --> Utf8 Class Initialized
INFO - 2017-05-22 00:02:15 --> URI Class Initialized
INFO - 2017-05-22 00:02:15 --> Router Class Initialized
INFO - 2017-05-22 00:02:15 --> Output Class Initialized
INFO - 2017-05-22 00:02:15 --> Security Class Initialized
DEBUG - 2017-05-22 00:02:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:02:15 --> Input Class Initialized
INFO - 2017-05-22 00:02:15 --> Language Class Initialized
INFO - 2017-05-22 00:02:15 --> Loader Class Initialized
INFO - 2017-05-22 00:02:15 --> Helper loaded: url_helper
INFO - 2017-05-22 00:02:15 --> Helper loaded: file_helper
INFO - 2017-05-22 00:02:15 --> Helper loaded: common_helper
INFO - 2017-05-22 00:02:15 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:02:15 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:02:15 --> Helper loaded: message_helper
INFO - 2017-05-22 00:02:15 --> Database Driver Class Initialized
INFO - 2017-05-22 00:02:15 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:02:15 --> Helper loaded: form_helper
INFO - 2017-05-22 00:02:15 --> Form Validation Class Initialized
INFO - 2017-05-22 00:02:15 --> Controller Class Initialized
INFO - 2017-05-22 00:02:15 --> Model Class Initialized
INFO - 2017-05-22 00:02:15 --> Model Class Initialized
ERROR - 2017-05-22 00:02:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY `us`.`id` DESC
 LIMIT 25' at line 18 - Invalid query: SELECT SQL_CALC_FOUND_ROWS us.id, us.fullname, us.id_number, us.email, us.telephone, uss.fullname as client_name, jobs.title, us.created_date, us.company, us.is_delete, us.status
FROM `users` as `us`
LEFT JOIN `booking` as `bk` ON `us`.`candidate_booking_id`=`bk`.`id`
LEFT JOIN `users` as `uss` ON `uss`.`id`=`bk`.`client_id`
LEFT JOIN `jobs` ON `jobs`.`id`=`bk`.`job_id`
WHERE   (
`us`.`id` = 'developer'
OR `us`.`fullname` = 'developer'
OR `us`.`id_number` = 'developer'
OR `us`.`email` = 'developer'
OR `us`.`telephone` = 'developer'
OR `uss`.`fullname` = 'developer'
OR `jobs`.`title` = 'developer'
OR `us`.`created_date` = 'developer'
OR `us`.`company` = 'developer'
AND `us`.`user_role` = 'CANDIDATE'
AND `us`.`is_delete` = '0'
ORDER BY `us`.`id` DESC
 LIMIT 25
INFO - 2017-05-22 00:02:15 --> Language file loaded: language/english/db_lang.php
INFO - 2017-05-22 00:02:22 --> Config Class Initialized
INFO - 2017-05-22 00:02:22 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:02:22 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:02:22 --> Utf8 Class Initialized
INFO - 2017-05-22 00:02:22 --> URI Class Initialized
INFO - 2017-05-22 00:02:22 --> Router Class Initialized
INFO - 2017-05-22 00:02:22 --> Output Class Initialized
INFO - 2017-05-22 00:02:22 --> Security Class Initialized
DEBUG - 2017-05-22 00:02:22 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:02:22 --> Input Class Initialized
INFO - 2017-05-22 00:02:22 --> Language Class Initialized
INFO - 2017-05-22 00:02:22 --> Loader Class Initialized
INFO - 2017-05-22 00:02:22 --> Helper loaded: url_helper
INFO - 2017-05-22 00:02:23 --> Helper loaded: file_helper
INFO - 2017-05-22 00:02:23 --> Helper loaded: common_helper
INFO - 2017-05-22 00:02:23 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:02:23 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:02:23 --> Helper loaded: message_helper
INFO - 2017-05-22 00:02:23 --> Database Driver Class Initialized
INFO - 2017-05-22 00:02:23 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:02:23 --> Helper loaded: form_helper
INFO - 2017-05-22 00:02:23 --> Form Validation Class Initialized
INFO - 2017-05-22 00:02:23 --> Controller Class Initialized
INFO - 2017-05-22 00:02:23 --> Model Class Initialized
INFO - 2017-05-22 00:02:23 --> Model Class Initialized
ERROR - 2017-05-22 00:02:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY `us`.`id` DESC
 LIMIT 25' at line 18 - Invalid query: SELECT SQL_CALC_FOUND_ROWS us.id, us.fullname, us.id_number, us.email, us.telephone, uss.fullname as client_name, jobs.title, us.created_date, us.company, us.is_delete, us.status
FROM `users` as `us`
LEFT JOIN `booking` as `bk` ON `us`.`candidate_booking_id`=`bk`.`id`
LEFT JOIN `users` as `uss` ON `uss`.`id`=`bk`.`client_id`
LEFT JOIN `jobs` ON `jobs`.`id`=`bk`.`job_id`
WHERE   (
`us`.`id` = 'developer'
OR `us`.`fullname` = 'developer'
OR `us`.`id_number` = 'developer'
OR `us`.`email` = 'developer'
OR `us`.`telephone` = 'developer'
OR `uss`.`fullname` = 'developer'
OR `jobs`.`title` = 'developer'
OR `us`.`created_date` = 'developer'
OR `us`.`company` = 'developer'
AND `us`.`user_role` = 'CANDIDATE'
AND `us`.`is_delete` = '0'
ORDER BY `us`.`id` DESC
 LIMIT 25
INFO - 2017-05-22 00:02:23 --> Language file loaded: language/english/db_lang.php
INFO - 2017-05-22 00:02:42 --> Config Class Initialized
INFO - 2017-05-22 00:02:42 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:02:42 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:02:42 --> Utf8 Class Initialized
INFO - 2017-05-22 00:02:42 --> URI Class Initialized
INFO - 2017-05-22 00:02:42 --> Router Class Initialized
INFO - 2017-05-22 00:02:42 --> Output Class Initialized
INFO - 2017-05-22 00:02:42 --> Security Class Initialized
DEBUG - 2017-05-22 00:02:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:02:42 --> Input Class Initialized
INFO - 2017-05-22 00:02:42 --> Language Class Initialized
INFO - 2017-05-22 00:02:42 --> Loader Class Initialized
INFO - 2017-05-22 00:02:42 --> Helper loaded: url_helper
INFO - 2017-05-22 00:02:42 --> Helper loaded: file_helper
INFO - 2017-05-22 00:02:42 --> Helper loaded: common_helper
INFO - 2017-05-22 00:02:42 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:02:42 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:02:42 --> Helper loaded: message_helper
INFO - 2017-05-22 00:02:42 --> Database Driver Class Initialized
INFO - 2017-05-22 00:02:42 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:02:42 --> Helper loaded: form_helper
INFO - 2017-05-22 00:02:42 --> Form Validation Class Initialized
INFO - 2017-05-22 00:02:42 --> Controller Class Initialized
INFO - 2017-05-22 00:02:42 --> Model Class Initialized
INFO - 2017-05-22 00:02:42 --> Model Class Initialized
ERROR - 2017-05-22 00:02:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY `us`.`id` DESC
 LIMIT 25' at line 18 - Invalid query: SELECT SQL_CALC_FOUND_ROWS us.id, us.fullname, us.id_number, us.email, us.telephone, uss.fullname as client_name, jobs.title, us.created_date, us.company, us.is_delete, us.status
FROM `users` as `us`
LEFT JOIN `booking` as `bk` ON `us`.`candidate_booking_id`=`bk`.`id`
LEFT JOIN `users` as `uss` ON `uss`.`id`=`bk`.`client_id`
LEFT JOIN `jobs` ON `jobs`.`id`=`bk`.`job_id`
WHERE   (
`us`.`id` = 'developer'
OR `us`.`fullname` = 'developer'
OR `us`.`id_number` = 'developer'
OR `us`.`email` = 'developer'
OR `us`.`telephone` = 'developer'
OR `uss`.`fullname` = 'developer'
OR `jobs`.`title` = 'developer'
OR `us`.`created_date` = 'developer'
OR `us`.`company` = 'developer'
AND `us`.`user_role` = 'CANDIDATE'
AND `us`.`is_delete` = '0'
ORDER BY `us`.`id` DESC
 LIMIT 25
INFO - 2017-05-22 00:02:42 --> Language file loaded: language/english/db_lang.php
INFO - 2017-05-22 00:03:44 --> Config Class Initialized
INFO - 2017-05-22 00:03:44 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:03:44 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:03:44 --> Utf8 Class Initialized
INFO - 2017-05-22 00:03:44 --> URI Class Initialized
INFO - 2017-05-22 00:03:44 --> Router Class Initialized
INFO - 2017-05-22 00:03:44 --> Output Class Initialized
INFO - 2017-05-22 00:03:44 --> Security Class Initialized
DEBUG - 2017-05-22 00:03:44 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:03:44 --> Input Class Initialized
INFO - 2017-05-22 00:03:44 --> Language Class Initialized
INFO - 2017-05-22 00:03:44 --> Loader Class Initialized
INFO - 2017-05-22 00:03:44 --> Helper loaded: url_helper
INFO - 2017-05-22 00:03:44 --> Helper loaded: file_helper
INFO - 2017-05-22 00:03:44 --> Helper loaded: common_helper
INFO - 2017-05-22 00:03:44 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:03:44 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:03:44 --> Helper loaded: message_helper
INFO - 2017-05-22 00:03:44 --> Database Driver Class Initialized
INFO - 2017-05-22 00:03:44 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:03:44 --> Helper loaded: form_helper
INFO - 2017-05-22 00:03:44 --> Form Validation Class Initialized
INFO - 2017-05-22 00:03:44 --> Controller Class Initialized
INFO - 2017-05-22 00:03:44 --> Model Class Initialized
INFO - 2017-05-22 00:03:44 --> Model Class Initialized
INFO - 2017-05-22 00:04:01 --> Config Class Initialized
INFO - 2017-05-22 00:04:01 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:01 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:01 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:01 --> URI Class Initialized
INFO - 2017-05-22 00:04:01 --> Router Class Initialized
INFO - 2017-05-22 00:04:01 --> Output Class Initialized
INFO - 2017-05-22 00:04:01 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:01 --> Input Class Initialized
INFO - 2017-05-22 00:04:02 --> Language Class Initialized
INFO - 2017-05-22 00:04:02 --> Loader Class Initialized
INFO - 2017-05-22 00:04:02 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:02 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:02 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:02 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:02 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:02 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:02 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:02 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:02 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:02 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:02 --> Controller Class Initialized
INFO - 2017-05-22 00:04:02 --> Model Class Initialized
INFO - 2017-05-22 00:04:02 --> Model Class Initialized
INFO - 2017-05-22 00:04:20 --> Config Class Initialized
INFO - 2017-05-22 00:04:20 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:20 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:20 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:20 --> URI Class Initialized
INFO - 2017-05-22 00:04:20 --> Router Class Initialized
INFO - 2017-05-22 00:04:20 --> Output Class Initialized
INFO - 2017-05-22 00:04:20 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:20 --> Input Class Initialized
INFO - 2017-05-22 00:04:20 --> Language Class Initialized
INFO - 2017-05-22 00:04:20 --> Loader Class Initialized
INFO - 2017-05-22 00:04:20 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:20 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:20 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:20 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:20 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:20 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:20 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:20 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:20 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:20 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:20 --> Controller Class Initialized
INFO - 2017-05-22 00:04:20 --> Model Class Initialized
INFO - 2017-05-22 00:04:20 --> Model Class Initialized
INFO - 2017-05-22 00:04:28 --> Config Class Initialized
INFO - 2017-05-22 00:04:28 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:28 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:28 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:28 --> URI Class Initialized
INFO - 2017-05-22 00:04:28 --> Router Class Initialized
INFO - 2017-05-22 00:04:28 --> Output Class Initialized
INFO - 2017-05-22 00:04:28 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:28 --> Input Class Initialized
INFO - 2017-05-22 00:04:28 --> Language Class Initialized
INFO - 2017-05-22 00:04:28 --> Loader Class Initialized
INFO - 2017-05-22 00:04:28 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:28 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:28 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:28 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:28 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:28 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:28 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:28 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:28 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:28 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:28 --> Controller Class Initialized
INFO - 2017-05-22 00:04:28 --> Model Class Initialized
INFO - 2017-05-22 00:04:28 --> Model Class Initialized
INFO - 2017-05-22 00:04:34 --> Config Class Initialized
INFO - 2017-05-22 00:04:34 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:35 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:35 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:35 --> URI Class Initialized
INFO - 2017-05-22 00:04:35 --> Router Class Initialized
INFO - 2017-05-22 00:04:35 --> Output Class Initialized
INFO - 2017-05-22 00:04:35 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:35 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:35 --> Input Class Initialized
INFO - 2017-05-22 00:04:35 --> Language Class Initialized
INFO - 2017-05-22 00:04:35 --> Loader Class Initialized
INFO - 2017-05-22 00:04:35 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:35 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:35 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:35 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:35 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:35 --> Controller Class Initialized
INFO - 2017-05-22 00:04:35 --> Model Class Initialized
INFO - 2017-05-22 00:04:35 --> Model Class Initialized
INFO - 2017-05-22 00:04:35 --> Config Class Initialized
INFO - 2017-05-22 00:04:35 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:35 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:35 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:35 --> URI Class Initialized
INFO - 2017-05-22 00:04:35 --> Router Class Initialized
INFO - 2017-05-22 00:04:35 --> Output Class Initialized
INFO - 2017-05-22 00:04:35 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:35 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:35 --> Input Class Initialized
INFO - 2017-05-22 00:04:35 --> Language Class Initialized
INFO - 2017-05-22 00:04:35 --> Loader Class Initialized
INFO - 2017-05-22 00:04:35 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:35 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:35 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:35 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:35 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:35 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:35 --> Controller Class Initialized
INFO - 2017-05-22 00:04:35 --> Model Class Initialized
INFO - 2017-05-22 00:04:35 --> Model Class Initialized
INFO - 2017-05-22 00:04:36 --> Config Class Initialized
INFO - 2017-05-22 00:04:36 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:36 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:36 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:37 --> URI Class Initialized
INFO - 2017-05-22 00:04:37 --> Router Class Initialized
INFO - 2017-05-22 00:04:37 --> Output Class Initialized
INFO - 2017-05-22 00:04:37 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:37 --> Input Class Initialized
INFO - 2017-05-22 00:04:37 --> Language Class Initialized
INFO - 2017-05-22 00:04:37 --> Loader Class Initialized
INFO - 2017-05-22 00:04:37 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:37 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:37 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:37 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:37 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:37 --> Controller Class Initialized
INFO - 2017-05-22 00:04:37 --> Model Class Initialized
INFO - 2017-05-22 00:04:37 --> Model Class Initialized
INFO - 2017-05-22 00:04:37 --> Config Class Initialized
INFO - 2017-05-22 00:04:37 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:37 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:37 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:37 --> URI Class Initialized
INFO - 2017-05-22 00:04:37 --> Router Class Initialized
INFO - 2017-05-22 00:04:37 --> Output Class Initialized
INFO - 2017-05-22 00:04:37 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:37 --> Input Class Initialized
INFO - 2017-05-22 00:04:37 --> Language Class Initialized
INFO - 2017-05-22 00:04:37 --> Loader Class Initialized
INFO - 2017-05-22 00:04:37 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:37 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:37 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:37 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:37 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:37 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:37 --> Controller Class Initialized
INFO - 2017-05-22 00:04:37 --> Model Class Initialized
INFO - 2017-05-22 00:04:37 --> Model Class Initialized
INFO - 2017-05-22 00:04:37 --> Config Class Initialized
INFO - 2017-05-22 00:04:37 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:37 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:37 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:37 --> URI Class Initialized
INFO - 2017-05-22 00:04:37 --> Router Class Initialized
INFO - 2017-05-22 00:04:37 --> Output Class Initialized
INFO - 2017-05-22 00:04:38 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:38 --> Input Class Initialized
INFO - 2017-05-22 00:04:38 --> Language Class Initialized
INFO - 2017-05-22 00:04:38 --> Loader Class Initialized
INFO - 2017-05-22 00:04:38 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:38 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:38 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:38 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:38 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:38 --> Controller Class Initialized
INFO - 2017-05-22 00:04:38 --> Model Class Initialized
INFO - 2017-05-22 00:04:38 --> Model Class Initialized
INFO - 2017-05-22 00:04:38 --> Config Class Initialized
INFO - 2017-05-22 00:04:38 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:38 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:38 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:38 --> URI Class Initialized
INFO - 2017-05-22 00:04:38 --> Router Class Initialized
INFO - 2017-05-22 00:04:38 --> Output Class Initialized
INFO - 2017-05-22 00:04:38 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:38 --> Input Class Initialized
INFO - 2017-05-22 00:04:38 --> Language Class Initialized
INFO - 2017-05-22 00:04:38 --> Loader Class Initialized
INFO - 2017-05-22 00:04:38 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:38 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:38 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:38 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:38 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:38 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:38 --> Controller Class Initialized
INFO - 2017-05-22 00:04:38 --> Model Class Initialized
INFO - 2017-05-22 00:04:38 --> Model Class Initialized
INFO - 2017-05-22 00:04:38 --> Config Class Initialized
INFO - 2017-05-22 00:04:38 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:38 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:38 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:38 --> URI Class Initialized
INFO - 2017-05-22 00:04:38 --> Router Class Initialized
INFO - 2017-05-22 00:04:38 --> Output Class Initialized
INFO - 2017-05-22 00:04:38 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:38 --> Input Class Initialized
INFO - 2017-05-22 00:04:39 --> Language Class Initialized
INFO - 2017-05-22 00:04:39 --> Loader Class Initialized
INFO - 2017-05-22 00:04:39 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:39 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:39 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:39 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:39 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:39 --> Controller Class Initialized
INFO - 2017-05-22 00:04:39 --> Model Class Initialized
INFO - 2017-05-22 00:04:39 --> Model Class Initialized
INFO - 2017-05-22 00:04:39 --> Config Class Initialized
INFO - 2017-05-22 00:04:39 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:04:39 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:04:39 --> Utf8 Class Initialized
INFO - 2017-05-22 00:04:39 --> URI Class Initialized
INFO - 2017-05-22 00:04:39 --> Router Class Initialized
INFO - 2017-05-22 00:04:39 --> Output Class Initialized
INFO - 2017-05-22 00:04:39 --> Security Class Initialized
DEBUG - 2017-05-22 00:04:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:04:39 --> Input Class Initialized
INFO - 2017-05-22 00:04:39 --> Language Class Initialized
INFO - 2017-05-22 00:04:39 --> Loader Class Initialized
INFO - 2017-05-22 00:04:39 --> Helper loaded: url_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: file_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: common_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:04:39 --> Helper loaded: message_helper
INFO - 2017-05-22 00:04:39 --> Database Driver Class Initialized
INFO - 2017-05-22 00:04:39 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:04:39 --> Helper loaded: form_helper
INFO - 2017-05-22 00:04:39 --> Form Validation Class Initialized
INFO - 2017-05-22 00:04:39 --> Controller Class Initialized
INFO - 2017-05-22 00:04:39 --> Model Class Initialized
INFO - 2017-05-22 00:04:39 --> Model Class Initialized
INFO - 2017-05-22 00:05:03 --> Config Class Initialized
INFO - 2017-05-22 00:05:03 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:05:03 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:05:03 --> Utf8 Class Initialized
INFO - 2017-05-22 00:05:03 --> URI Class Initialized
INFO - 2017-05-22 00:05:03 --> Router Class Initialized
INFO - 2017-05-22 00:05:03 --> Output Class Initialized
INFO - 2017-05-22 00:05:03 --> Security Class Initialized
DEBUG - 2017-05-22 00:05:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:05:03 --> Input Class Initialized
INFO - 2017-05-22 00:05:03 --> Language Class Initialized
INFO - 2017-05-22 00:05:03 --> Loader Class Initialized
INFO - 2017-05-22 00:05:03 --> Helper loaded: url_helper
INFO - 2017-05-22 00:05:03 --> Helper loaded: file_helper
INFO - 2017-05-22 00:05:03 --> Helper loaded: common_helper
INFO - 2017-05-22 00:05:03 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:05:03 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:05:03 --> Helper loaded: message_helper
INFO - 2017-05-22 00:05:03 --> Database Driver Class Initialized
INFO - 2017-05-22 00:05:03 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:05:03 --> Helper loaded: form_helper
INFO - 2017-05-22 00:05:03 --> Form Validation Class Initialized
INFO - 2017-05-22 00:05:03 --> Controller Class Initialized
INFO - 2017-05-22 00:05:03 --> Model Class Initialized
INFO - 2017-05-22 00:05:03 --> Model Class Initialized
INFO - 2017-05-22 00:05:04 --> Config Class Initialized
INFO - 2017-05-22 00:05:04 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:05:04 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:05:04 --> Utf8 Class Initialized
INFO - 2017-05-22 00:05:04 --> URI Class Initialized
INFO - 2017-05-22 00:05:04 --> Router Class Initialized
INFO - 2017-05-22 00:05:04 --> Output Class Initialized
INFO - 2017-05-22 00:05:04 --> Security Class Initialized
DEBUG - 2017-05-22 00:05:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:05:04 --> Input Class Initialized
INFO - 2017-05-22 00:05:04 --> Language Class Initialized
INFO - 2017-05-22 00:05:04 --> Loader Class Initialized
INFO - 2017-05-22 00:05:04 --> Helper loaded: url_helper
INFO - 2017-05-22 00:05:04 --> Helper loaded: file_helper
INFO - 2017-05-22 00:05:04 --> Helper loaded: common_helper
INFO - 2017-05-22 00:05:04 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:05:04 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: message_helper
INFO - 2017-05-22 00:05:05 --> Database Driver Class Initialized
INFO - 2017-05-22 00:05:05 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:05:05 --> Helper loaded: form_helper
INFO - 2017-05-22 00:05:05 --> Form Validation Class Initialized
INFO - 2017-05-22 00:05:05 --> Controller Class Initialized
INFO - 2017-05-22 00:05:05 --> Model Class Initialized
INFO - 2017-05-22 00:05:05 --> Model Class Initialized
INFO - 2017-05-22 00:05:05 --> Config Class Initialized
INFO - 2017-05-22 00:05:05 --> Hooks Class Initialized
INFO - 2017-05-22 00:05:05 --> Config Class Initialized
DEBUG - 2017-05-22 00:05:05 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:05:05 --> Hooks Class Initialized
INFO - 2017-05-22 00:05:05 --> Utf8 Class Initialized
DEBUG - 2017-05-22 00:05:05 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:05:05 --> URI Class Initialized
INFO - 2017-05-22 00:05:05 --> Utf8 Class Initialized
INFO - 2017-05-22 00:05:05 --> URI Class Initialized
INFO - 2017-05-22 00:05:05 --> Router Class Initialized
INFO - 2017-05-22 00:05:05 --> Router Class Initialized
INFO - 2017-05-22 00:05:05 --> Output Class Initialized
INFO - 2017-05-22 00:05:05 --> Output Class Initialized
INFO - 2017-05-22 00:05:05 --> Security Class Initialized
INFO - 2017-05-22 00:05:05 --> Security Class Initialized
DEBUG - 2017-05-22 00:05:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-05-22 00:05:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:05:05 --> Input Class Initialized
INFO - 2017-05-22 00:05:05 --> Input Class Initialized
INFO - 2017-05-22 00:05:05 --> Language Class Initialized
INFO - 2017-05-22 00:05:05 --> Language Class Initialized
INFO - 2017-05-22 00:05:05 --> Loader Class Initialized
INFO - 2017-05-22 00:05:05 --> Loader Class Initialized
INFO - 2017-05-22 00:05:05 --> Helper loaded: url_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: url_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: file_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: file_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: common_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: common_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: message_helper
INFO - 2017-05-22 00:05:05 --> Helper loaded: message_helper
INFO - 2017-05-22 00:05:05 --> Database Driver Class Initialized
INFO - 2017-05-22 00:05:05 --> Database Driver Class Initialized
INFO - 2017-05-22 00:05:05 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:05:05 --> Helper loaded: form_helper
INFO - 2017-05-22 00:05:05 --> Form Validation Class Initialized
INFO - 2017-05-22 00:05:05 --> Controller Class Initialized
INFO - 2017-05-22 00:05:05 --> Model Class Initialized
INFO - 2017-05-22 00:05:05 --> Model Class Initialized
INFO - 2017-05-22 00:05:05 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:05:06 --> Helper loaded: form_helper
INFO - 2017-05-22 00:05:06 --> Form Validation Class Initialized
INFO - 2017-05-22 00:05:06 --> Controller Class Initialized
INFO - 2017-05-22 00:05:06 --> Model Class Initialized
INFO - 2017-05-22 00:05:06 --> Model Class Initialized
INFO - 2017-05-22 00:05:09 --> Config Class Initialized
INFO - 2017-05-22 00:05:09 --> Hooks Class Initialized
DEBUG - 2017-05-22 00:05:09 --> UTF-8 Support Enabled
INFO - 2017-05-22 00:05:09 --> Utf8 Class Initialized
INFO - 2017-05-22 00:05:09 --> URI Class Initialized
INFO - 2017-05-22 00:05:09 --> Router Class Initialized
INFO - 2017-05-22 00:05:09 --> Output Class Initialized
INFO - 2017-05-22 00:05:09 --> Security Class Initialized
DEBUG - 2017-05-22 00:05:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 00:05:09 --> Input Class Initialized
INFO - 2017-05-22 00:05:09 --> Language Class Initialized
INFO - 2017-05-22 00:05:09 --> Loader Class Initialized
INFO - 2017-05-22 00:05:09 --> Helper loaded: url_helper
INFO - 2017-05-22 00:05:09 --> Helper loaded: file_helper
INFO - 2017-05-22 00:05:09 --> Helper loaded: common_helper
INFO - 2017-05-22 00:05:09 --> Helper loaded: cookie_helper
INFO - 2017-05-22 00:05:09 --> Helper loaded: email_template_helper
INFO - 2017-05-22 00:05:09 --> Helper loaded: message_helper
INFO - 2017-05-22 00:05:09 --> Database Driver Class Initialized
INFO - 2017-05-22 00:05:09 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 00:05:09 --> Helper loaded: form_helper
INFO - 2017-05-22 00:05:09 --> Form Validation Class Initialized
INFO - 2017-05-22 00:05:09 --> Controller Class Initialized
INFO - 2017-05-22 00:05:09 --> Model Class Initialized
INFO - 2017-05-22 00:05:09 --> Model Class Initialized
INFO - 2017-05-22 00:05:09 --> Model Class Initialized
INFO - 2017-05-22 22:49:50 --> Config Class Initialized
INFO - 2017-05-22 22:49:50 --> Hooks Class Initialized
DEBUG - 2017-05-22 22:49:50 --> UTF-8 Support Enabled
INFO - 2017-05-22 22:49:50 --> Utf8 Class Initialized
INFO - 2017-05-22 22:49:50 --> URI Class Initialized
INFO - 2017-05-22 22:49:50 --> Router Class Initialized
INFO - 2017-05-22 22:49:51 --> Output Class Initialized
INFO - 2017-05-22 22:49:51 --> Security Class Initialized
DEBUG - 2017-05-22 22:49:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 22:49:51 --> Input Class Initialized
INFO - 2017-05-22 22:49:51 --> Language Class Initialized
INFO - 2017-05-22 22:49:51 --> Loader Class Initialized
INFO - 2017-05-22 22:49:51 --> Helper loaded: url_helper
INFO - 2017-05-22 22:49:51 --> Helper loaded: file_helper
INFO - 2017-05-22 22:49:52 --> Helper loaded: common_helper
INFO - 2017-05-22 22:49:52 --> Helper loaded: cookie_helper
INFO - 2017-05-22 22:49:52 --> Helper loaded: email_template_helper
INFO - 2017-05-22 22:49:52 --> Helper loaded: message_helper
INFO - 2017-05-22 22:49:52 --> Database Driver Class Initialized
INFO - 2017-05-22 22:49:53 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 22:49:53 --> Helper loaded: form_helper
INFO - 2017-05-22 22:49:53 --> Form Validation Class Initialized
INFO - 2017-05-22 22:49:53 --> Controller Class Initialized
INFO - 2017-05-22 22:49:53 --> Config Class Initialized
INFO - 2017-05-22 22:49:53 --> Hooks Class Initialized
DEBUG - 2017-05-22 22:49:53 --> UTF-8 Support Enabled
INFO - 2017-05-22 22:49:53 --> Utf8 Class Initialized
INFO - 2017-05-22 22:49:53 --> URI Class Initialized
INFO - 2017-05-22 22:49:53 --> Router Class Initialized
INFO - 2017-05-22 22:49:53 --> Output Class Initialized
INFO - 2017-05-22 22:49:53 --> Security Class Initialized
DEBUG - 2017-05-22 22:49:53 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 22:49:53 --> Input Class Initialized
INFO - 2017-05-22 22:49:53 --> Language Class Initialized
INFO - 2017-05-22 22:49:53 --> Loader Class Initialized
INFO - 2017-05-22 22:49:53 --> Helper loaded: url_helper
INFO - 2017-05-22 22:49:53 --> Helper loaded: file_helper
INFO - 2017-05-22 22:49:53 --> Helper loaded: common_helper
INFO - 2017-05-22 22:49:53 --> Helper loaded: cookie_helper
INFO - 2017-05-22 22:49:53 --> Helper loaded: email_template_helper
INFO - 2017-05-22 22:49:53 --> Helper loaded: message_helper
INFO - 2017-05-22 22:49:53 --> Database Driver Class Initialized
INFO - 2017-05-22 22:49:53 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 22:49:53 --> Helper loaded: form_helper
INFO - 2017-05-22 22:49:53 --> Form Validation Class Initialized
INFO - 2017-05-22 22:49:53 --> Controller Class Initialized
INFO - 2017-05-22 22:49:53 --> Model Class Initialized
INFO - 2017-05-22 22:49:53 --> Model Class Initialized
INFO - 2017-05-22 22:49:53 --> File loaded: C:\wamp\www\online_booking\application\views\include/front_header.php
INFO - 2017-05-22 22:49:53 --> File loaded: C:\wamp\www\online_booking\application\views\login.php
INFO - 2017-05-22 22:49:53 --> File loaded: C:\wamp\www\online_booking\application\views\include/front_footer.php
INFO - 2017-05-22 22:49:53 --> Final output sent to browser
DEBUG - 2017-05-22 22:49:53 --> Total execution time: 0.4351
INFO - 2017-05-22 22:50:15 --> Config Class Initialized
INFO - 2017-05-22 22:50:15 --> Hooks Class Initialized
DEBUG - 2017-05-22 22:50:15 --> UTF-8 Support Enabled
INFO - 2017-05-22 22:50:15 --> Utf8 Class Initialized
INFO - 2017-05-22 22:50:15 --> URI Class Initialized
INFO - 2017-05-22 22:50:15 --> Router Class Initialized
INFO - 2017-05-22 22:50:15 --> Output Class Initialized
INFO - 2017-05-22 22:50:15 --> Security Class Initialized
DEBUG - 2017-05-22 22:50:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 22:50:15 --> Input Class Initialized
INFO - 2017-05-22 22:50:15 --> Language Class Initialized
INFO - 2017-05-22 22:50:15 --> Loader Class Initialized
INFO - 2017-05-22 22:50:15 --> Helper loaded: url_helper
INFO - 2017-05-22 22:50:15 --> Helper loaded: file_helper
INFO - 2017-05-22 22:50:15 --> Helper loaded: common_helper
INFO - 2017-05-22 22:50:15 --> Helper loaded: cookie_helper
INFO - 2017-05-22 22:50:15 --> Helper loaded: email_template_helper
INFO - 2017-05-22 22:50:15 --> Helper loaded: message_helper
INFO - 2017-05-22 22:50:15 --> Database Driver Class Initialized
INFO - 2017-05-22 22:50:16 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 22:50:16 --> Helper loaded: form_helper
INFO - 2017-05-22 22:50:16 --> Form Validation Class Initialized
INFO - 2017-05-22 22:50:16 --> Controller Class Initialized
INFO - 2017-05-22 22:50:16 --> Model Class Initialized
INFO - 2017-05-22 22:50:16 --> Model Class Initialized
INFO - 2017-05-22 22:50:16 --> Config Class Initialized
INFO - 2017-05-22 22:50:16 --> Hooks Class Initialized
DEBUG - 2017-05-22 22:50:16 --> UTF-8 Support Enabled
INFO - 2017-05-22 22:50:16 --> Utf8 Class Initialized
INFO - 2017-05-22 22:50:16 --> URI Class Initialized
INFO - 2017-05-22 22:50:16 --> Router Class Initialized
INFO - 2017-05-22 22:50:16 --> Output Class Initialized
INFO - 2017-05-22 22:50:17 --> Security Class Initialized
DEBUG - 2017-05-22 22:50:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 22:50:17 --> Input Class Initialized
INFO - 2017-05-22 22:50:17 --> Language Class Initialized
INFO - 2017-05-22 22:50:17 --> Loader Class Initialized
INFO - 2017-05-22 22:50:17 --> Helper loaded: url_helper
INFO - 2017-05-22 22:50:17 --> Helper loaded: file_helper
INFO - 2017-05-22 22:50:17 --> Helper loaded: common_helper
INFO - 2017-05-22 22:50:17 --> Helper loaded: cookie_helper
INFO - 2017-05-22 22:50:17 --> Helper loaded: email_template_helper
INFO - 2017-05-22 22:50:17 --> Helper loaded: message_helper
INFO - 2017-05-22 22:50:17 --> Database Driver Class Initialized
INFO - 2017-05-22 22:50:17 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 22:50:17 --> Helper loaded: form_helper
INFO - 2017-05-22 22:50:17 --> Form Validation Class Initialized
INFO - 2017-05-22 22:50:17 --> Controller Class Initialized
INFO - 2017-05-22 22:50:17 --> Model Class Initialized
INFO - 2017-05-22 22:50:17 --> Model Class Initialized
INFO - 2017-05-22 22:50:17 --> Config Class Initialized
INFO - 2017-05-22 22:50:17 --> Hooks Class Initialized
DEBUG - 2017-05-22 22:50:17 --> UTF-8 Support Enabled
INFO - 2017-05-22 22:50:17 --> Utf8 Class Initialized
INFO - 2017-05-22 22:50:17 --> URI Class Initialized
INFO - 2017-05-22 22:50:17 --> Router Class Initialized
INFO - 2017-05-22 22:50:17 --> Output Class Initialized
INFO - 2017-05-22 22:50:17 --> Security Class Initialized
DEBUG - 2017-05-22 22:50:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 22:50:17 --> Input Class Initialized
INFO - 2017-05-22 22:50:18 --> Language Class Initialized
INFO - 2017-05-22 22:50:18 --> Loader Class Initialized
INFO - 2017-05-22 22:50:18 --> Helper loaded: url_helper
INFO - 2017-05-22 22:50:18 --> Helper loaded: file_helper
INFO - 2017-05-22 22:50:18 --> Helper loaded: common_helper
INFO - 2017-05-22 22:50:18 --> Helper loaded: cookie_helper
INFO - 2017-05-22 22:50:18 --> Helper loaded: email_template_helper
INFO - 2017-05-22 22:50:18 --> Helper loaded: message_helper
INFO - 2017-05-22 22:50:18 --> Database Driver Class Initialized
INFO - 2017-05-22 22:50:18 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 22:50:18 --> Helper loaded: form_helper
INFO - 2017-05-22 22:50:18 --> Form Validation Class Initialized
INFO - 2017-05-22 22:50:18 --> Controller Class Initialized
INFO - 2017-05-22 22:50:18 --> Model Class Initialized
INFO - 2017-05-22 22:50:18 --> Model Class Initialized
INFO - 2017-05-22 22:50:18 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 22:50:18 --> Model Class Initialized
INFO - 2017-05-22 22:50:18 --> File loaded: C:\wamp\www\online_booking\application\views\home.php
INFO - 2017-05-22 22:50:18 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 22:50:18 --> Final output sent to browser
DEBUG - 2017-05-22 22:50:18 --> Total execution time: 1.1184
INFO - 2017-05-22 23:01:38 --> Config Class Initialized
INFO - 2017-05-22 23:01:38 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:01:38 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:01:38 --> Utf8 Class Initialized
INFO - 2017-05-22 23:01:38 --> URI Class Initialized
INFO - 2017-05-22 23:01:38 --> Router Class Initialized
INFO - 2017-05-22 23:01:38 --> Output Class Initialized
INFO - 2017-05-22 23:01:38 --> Security Class Initialized
DEBUG - 2017-05-22 23:01:38 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:01:38 --> Input Class Initialized
INFO - 2017-05-22 23:01:38 --> Language Class Initialized
INFO - 2017-05-22 23:01:38 --> Loader Class Initialized
INFO - 2017-05-22 23:01:38 --> Helper loaded: url_helper
INFO - 2017-05-22 23:01:38 --> Helper loaded: file_helper
INFO - 2017-05-22 23:01:38 --> Helper loaded: common_helper
INFO - 2017-05-22 23:01:39 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:01:39 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:01:39 --> Helper loaded: message_helper
INFO - 2017-05-22 23:01:39 --> Database Driver Class Initialized
INFO - 2017-05-22 23:01:39 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:01:39 --> Helper loaded: form_helper
INFO - 2017-05-22 23:01:39 --> Form Validation Class Initialized
INFO - 2017-05-22 23:01:39 --> Controller Class Initialized
INFO - 2017-05-22 23:01:39 --> Model Class Initialized
INFO - 2017-05-22 23:01:39 --> Model Class Initialized
INFO - 2017-05-22 23:01:39 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:01:39 --> File loaded: C:\wamp\www\online_booking\application\views\booking.php
INFO - 2017-05-22 23:01:39 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:01:39 --> Final output sent to browser
DEBUG - 2017-05-22 23:01:39 --> Total execution time: 1.1292
INFO - 2017-05-22 23:01:41 --> Config Class Initialized
INFO - 2017-05-22 23:01:41 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:01:41 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:01:41 --> Utf8 Class Initialized
INFO - 2017-05-22 23:01:41 --> URI Class Initialized
INFO - 2017-05-22 23:01:41 --> Router Class Initialized
INFO - 2017-05-22 23:01:41 --> Output Class Initialized
INFO - 2017-05-22 23:01:41 --> Security Class Initialized
DEBUG - 2017-05-22 23:01:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:01:41 --> Input Class Initialized
INFO - 2017-05-22 23:01:41 --> Language Class Initialized
INFO - 2017-05-22 23:01:41 --> Loader Class Initialized
INFO - 2017-05-22 23:01:41 --> Helper loaded: url_helper
INFO - 2017-05-22 23:01:41 --> Helper loaded: file_helper
INFO - 2017-05-22 23:01:41 --> Helper loaded: common_helper
INFO - 2017-05-22 23:01:41 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:01:41 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:01:41 --> Helper loaded: message_helper
INFO - 2017-05-22 23:01:41 --> Database Driver Class Initialized
INFO - 2017-05-22 23:01:41 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:01:41 --> Helper loaded: form_helper
INFO - 2017-05-22 23:01:41 --> Form Validation Class Initialized
INFO - 2017-05-22 23:01:41 --> Controller Class Initialized
INFO - 2017-05-22 23:01:41 --> Model Class Initialized
INFO - 2017-05-22 23:01:41 --> Model Class Initialized
INFO - 2017-05-22 23:01:42 --> Config Class Initialized
INFO - 2017-05-22 23:01:42 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:01:42 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:01:42 --> Utf8 Class Initialized
INFO - 2017-05-22 23:01:42 --> URI Class Initialized
INFO - 2017-05-22 23:01:42 --> Router Class Initialized
INFO - 2017-05-22 23:01:42 --> Output Class Initialized
INFO - 2017-05-22 23:01:42 --> Security Class Initialized
DEBUG - 2017-05-22 23:01:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:01:42 --> Input Class Initialized
INFO - 2017-05-22 23:01:42 --> Language Class Initialized
INFO - 2017-05-22 23:01:42 --> Loader Class Initialized
INFO - 2017-05-22 23:01:42 --> Helper loaded: url_helper
INFO - 2017-05-22 23:01:42 --> Helper loaded: file_helper
INFO - 2017-05-22 23:01:42 --> Helper loaded: common_helper
INFO - 2017-05-22 23:01:42 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:01:42 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:01:42 --> Helper loaded: message_helper
INFO - 2017-05-22 23:01:42 --> Database Driver Class Initialized
INFO - 2017-05-22 23:01:42 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:01:42 --> Helper loaded: form_helper
INFO - 2017-05-22 23:01:43 --> Form Validation Class Initialized
INFO - 2017-05-22 23:01:43 --> Controller Class Initialized
INFO - 2017-05-22 23:01:43 --> Model Class Initialized
INFO - 2017-05-22 23:01:43 --> Model Class Initialized
INFO - 2017-05-22 23:01:43 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:01:43 --> File loaded: C:\wamp\www\online_booking\application\views\booking_details.php
INFO - 2017-05-22 23:01:43 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:01:43 --> Final output sent to browser
DEBUG - 2017-05-22 23:01:43 --> Total execution time: 1.0113
INFO - 2017-05-22 23:01:45 --> Config Class Initialized
INFO - 2017-05-22 23:01:45 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:01:45 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:01:45 --> Utf8 Class Initialized
INFO - 2017-05-22 23:01:45 --> URI Class Initialized
INFO - 2017-05-22 23:01:45 --> Router Class Initialized
INFO - 2017-05-22 23:01:45 --> Output Class Initialized
INFO - 2017-05-22 23:01:45 --> Security Class Initialized
DEBUG - 2017-05-22 23:01:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:01:45 --> Input Class Initialized
INFO - 2017-05-22 23:01:45 --> Language Class Initialized
INFO - 2017-05-22 23:01:45 --> Loader Class Initialized
INFO - 2017-05-22 23:01:45 --> Helper loaded: url_helper
INFO - 2017-05-22 23:01:45 --> Helper loaded: file_helper
INFO - 2017-05-22 23:01:45 --> Helper loaded: common_helper
INFO - 2017-05-22 23:01:45 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:01:45 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:01:45 --> Helper loaded: message_helper
INFO - 2017-05-22 23:01:45 --> Database Driver Class Initialized
INFO - 2017-05-22 23:01:45 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:01:45 --> Helper loaded: form_helper
INFO - 2017-05-22 23:01:45 --> Form Validation Class Initialized
INFO - 2017-05-22 23:01:45 --> Controller Class Initialized
INFO - 2017-05-22 23:01:45 --> Model Class Initialized
INFO - 2017-05-22 23:01:45 --> Model Class Initialized
INFO - 2017-05-22 23:02:02 --> Config Class Initialized
INFO - 2017-05-22 23:02:02 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:02:02 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:02:02 --> Utf8 Class Initialized
INFO - 2017-05-22 23:02:02 --> URI Class Initialized
INFO - 2017-05-22 23:02:02 --> Router Class Initialized
INFO - 2017-05-22 23:02:02 --> Output Class Initialized
INFO - 2017-05-22 23:02:02 --> Security Class Initialized
DEBUG - 2017-05-22 23:02:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:02:02 --> Input Class Initialized
INFO - 2017-05-22 23:02:02 --> Language Class Initialized
INFO - 2017-05-22 23:02:02 --> Loader Class Initialized
INFO - 2017-05-22 23:02:02 --> Helper loaded: url_helper
INFO - 2017-05-22 23:02:02 --> Helper loaded: file_helper
INFO - 2017-05-22 23:02:02 --> Helper loaded: common_helper
INFO - 2017-05-22 23:02:03 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:02:03 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:02:03 --> Helper loaded: message_helper
INFO - 2017-05-22 23:02:03 --> Database Driver Class Initialized
INFO - 2017-05-22 23:02:03 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:02:03 --> Helper loaded: form_helper
INFO - 2017-05-22 23:02:03 --> Form Validation Class Initialized
INFO - 2017-05-22 23:02:03 --> Controller Class Initialized
INFO - 2017-05-22 23:02:03 --> Model Class Initialized
INFO - 2017-05-22 23:02:03 --> Model Class Initialized
INFO - 2017-05-22 23:02:03 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:02:03 --> File loaded: C:\wamp\www\online_booking\application\views\booking.php
INFO - 2017-05-22 23:02:03 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:02:03 --> Final output sent to browser
DEBUG - 2017-05-22 23:02:03 --> Total execution time: 0.6904
INFO - 2017-05-22 23:02:05 --> Config Class Initialized
INFO - 2017-05-22 23:02:05 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:02:05 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:02:05 --> Utf8 Class Initialized
INFO - 2017-05-22 23:02:05 --> URI Class Initialized
INFO - 2017-05-22 23:02:05 --> Router Class Initialized
INFO - 2017-05-22 23:02:05 --> Output Class Initialized
INFO - 2017-05-22 23:02:05 --> Security Class Initialized
DEBUG - 2017-05-22 23:02:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:02:05 --> Input Class Initialized
INFO - 2017-05-22 23:02:05 --> Language Class Initialized
INFO - 2017-05-22 23:02:05 --> Loader Class Initialized
INFO - 2017-05-22 23:02:05 --> Helper loaded: url_helper
INFO - 2017-05-22 23:02:05 --> Helper loaded: file_helper
INFO - 2017-05-22 23:02:05 --> Helper loaded: common_helper
INFO - 2017-05-22 23:02:05 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:02:05 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:02:05 --> Helper loaded: message_helper
INFO - 2017-05-22 23:02:05 --> Database Driver Class Initialized
INFO - 2017-05-22 23:02:05 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:02:05 --> Helper loaded: form_helper
INFO - 2017-05-22 23:02:05 --> Form Validation Class Initialized
INFO - 2017-05-22 23:02:05 --> Controller Class Initialized
INFO - 2017-05-22 23:02:05 --> Model Class Initialized
INFO - 2017-05-22 23:02:05 --> Model Class Initialized
INFO - 2017-05-22 23:03:19 --> Config Class Initialized
INFO - 2017-05-22 23:03:19 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:03:19 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:03:19 --> Utf8 Class Initialized
INFO - 2017-05-22 23:03:19 --> URI Class Initialized
INFO - 2017-05-22 23:03:19 --> Router Class Initialized
INFO - 2017-05-22 23:03:19 --> Output Class Initialized
INFO - 2017-05-22 23:03:19 --> Security Class Initialized
DEBUG - 2017-05-22 23:03:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:03:19 --> Input Class Initialized
INFO - 2017-05-22 23:03:19 --> Language Class Initialized
INFO - 2017-05-22 23:03:19 --> Loader Class Initialized
INFO - 2017-05-22 23:03:19 --> Helper loaded: url_helper
INFO - 2017-05-22 23:03:19 --> Helper loaded: file_helper
INFO - 2017-05-22 23:03:19 --> Helper loaded: common_helper
INFO - 2017-05-22 23:03:19 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:03:20 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:03:20 --> Helper loaded: message_helper
INFO - 2017-05-22 23:03:20 --> Database Driver Class Initialized
INFO - 2017-05-22 23:03:20 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:03:20 --> Helper loaded: form_helper
INFO - 2017-05-22 23:03:20 --> Form Validation Class Initialized
INFO - 2017-05-22 23:03:20 --> Controller Class Initialized
INFO - 2017-05-22 23:03:20 --> Model Class Initialized
INFO - 2017-05-22 23:03:20 --> Model Class Initialized
INFO - 2017-05-22 23:03:20 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:03:20 --> File loaded: C:\wamp\www\online_booking\application\views\booking_details.php
INFO - 2017-05-22 23:03:20 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:03:20 --> Final output sent to browser
DEBUG - 2017-05-22 23:03:20 --> Total execution time: 0.3600
INFO - 2017-05-22 23:03:20 --> Config Class Initialized
INFO - 2017-05-22 23:03:20 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:03:20 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:03:20 --> Utf8 Class Initialized
INFO - 2017-05-22 23:03:20 --> URI Class Initialized
INFO - 2017-05-22 23:03:20 --> Router Class Initialized
INFO - 2017-05-22 23:03:20 --> Output Class Initialized
INFO - 2017-05-22 23:03:20 --> Security Class Initialized
DEBUG - 2017-05-22 23:03:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:03:21 --> Input Class Initialized
INFO - 2017-05-22 23:03:21 --> Language Class Initialized
INFO - 2017-05-22 23:03:21 --> Loader Class Initialized
INFO - 2017-05-22 23:03:21 --> Helper loaded: url_helper
INFO - 2017-05-22 23:03:21 --> Helper loaded: file_helper
INFO - 2017-05-22 23:03:21 --> Helper loaded: common_helper
INFO - 2017-05-22 23:03:21 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:03:21 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:03:21 --> Helper loaded: message_helper
INFO - 2017-05-22 23:03:21 --> Database Driver Class Initialized
INFO - 2017-05-22 23:03:21 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:03:21 --> Helper loaded: form_helper
INFO - 2017-05-22 23:03:21 --> Form Validation Class Initialized
INFO - 2017-05-22 23:03:21 --> Controller Class Initialized
INFO - 2017-05-22 23:03:21 --> Model Class Initialized
INFO - 2017-05-22 23:03:21 --> Model Class Initialized
INFO - 2017-05-22 23:03:29 --> Config Class Initialized
INFO - 2017-05-22 23:03:29 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:03:29 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:03:29 --> Utf8 Class Initialized
INFO - 2017-05-22 23:03:29 --> URI Class Initialized
INFO - 2017-05-22 23:03:29 --> Router Class Initialized
INFO - 2017-05-22 23:03:29 --> Output Class Initialized
INFO - 2017-05-22 23:03:29 --> Security Class Initialized
DEBUG - 2017-05-22 23:03:29 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:03:29 --> Input Class Initialized
INFO - 2017-05-22 23:03:29 --> Language Class Initialized
INFO - 2017-05-22 23:03:29 --> Loader Class Initialized
INFO - 2017-05-22 23:03:29 --> Helper loaded: url_helper
INFO - 2017-05-22 23:03:29 --> Helper loaded: file_helper
INFO - 2017-05-22 23:03:29 --> Helper loaded: common_helper
INFO - 2017-05-22 23:03:29 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:03:29 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:03:29 --> Helper loaded: message_helper
INFO - 2017-05-22 23:03:30 --> Database Driver Class Initialized
INFO - 2017-05-22 23:03:30 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:03:30 --> Helper loaded: form_helper
INFO - 2017-05-22 23:03:30 --> Form Validation Class Initialized
INFO - 2017-05-22 23:03:30 --> Controller Class Initialized
INFO - 2017-05-22 23:03:30 --> Model Class Initialized
INFO - 2017-05-22 23:03:30 --> Model Class Initialized
INFO - 2017-05-22 23:03:30 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:03:30 --> File loaded: C:\wamp\www\online_booking\application\views\add_edit_bookings.php
INFO - 2017-05-22 23:03:30 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:03:30 --> Final output sent to browser
DEBUG - 2017-05-22 23:03:30 --> Total execution time: 0.9892
INFO - 2017-05-22 23:27:34 --> Config Class Initialized
INFO - 2017-05-22 23:27:34 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:27:34 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:27:34 --> Utf8 Class Initialized
INFO - 2017-05-22 23:27:34 --> URI Class Initialized
INFO - 2017-05-22 23:27:34 --> Router Class Initialized
INFO - 2017-05-22 23:27:34 --> Output Class Initialized
INFO - 2017-05-22 23:27:34 --> Security Class Initialized
DEBUG - 2017-05-22 23:27:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:27:34 --> Input Class Initialized
INFO - 2017-05-22 23:27:34 --> Language Class Initialized
INFO - 2017-05-22 23:27:34 --> Loader Class Initialized
INFO - 2017-05-22 23:27:34 --> Helper loaded: url_helper
INFO - 2017-05-22 23:27:34 --> Helper loaded: file_helper
INFO - 2017-05-22 23:27:34 --> Helper loaded: common_helper
INFO - 2017-05-22 23:27:34 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:27:34 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:27:34 --> Helper loaded: message_helper
INFO - 2017-05-22 23:27:34 --> Database Driver Class Initialized
INFO - 2017-05-22 23:27:34 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:27:34 --> Helper loaded: form_helper
INFO - 2017-05-22 23:27:34 --> Form Validation Class Initialized
INFO - 2017-05-22 23:27:34 --> Controller Class Initialized
INFO - 2017-05-22 23:27:34 --> Model Class Initialized
INFO - 2017-05-22 23:27:34 --> Model Class Initialized
INFO - 2017-05-22 23:27:34 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:27:34 --> File loaded: C:\wamp\www\online_booking\application\views\add_edit_bookings.php
INFO - 2017-05-22 23:27:34 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:27:35 --> Final output sent to browser
DEBUG - 2017-05-22 23:27:35 --> Total execution time: 0.9491
INFO - 2017-05-22 23:27:51 --> Config Class Initialized
INFO - 2017-05-22 23:27:51 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:27:51 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:27:51 --> Utf8 Class Initialized
INFO - 2017-05-22 23:27:51 --> URI Class Initialized
INFO - 2017-05-22 23:27:51 --> Router Class Initialized
INFO - 2017-05-22 23:27:51 --> Output Class Initialized
INFO - 2017-05-22 23:27:51 --> Security Class Initialized
DEBUG - 2017-05-22 23:27:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:27:51 --> Input Class Initialized
INFO - 2017-05-22 23:27:51 --> Language Class Initialized
INFO - 2017-05-22 23:27:51 --> Loader Class Initialized
INFO - 2017-05-22 23:27:51 --> Helper loaded: url_helper
INFO - 2017-05-22 23:27:51 --> Helper loaded: file_helper
INFO - 2017-05-22 23:27:51 --> Helper loaded: common_helper
INFO - 2017-05-22 23:27:52 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:27:52 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:27:52 --> Helper loaded: message_helper
INFO - 2017-05-22 23:27:52 --> Database Driver Class Initialized
INFO - 2017-05-22 23:27:52 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:27:52 --> Helper loaded: form_helper
INFO - 2017-05-22 23:27:52 --> Form Validation Class Initialized
INFO - 2017-05-22 23:27:52 --> Controller Class Initialized
INFO - 2017-05-22 23:27:52 --> Model Class Initialized
INFO - 2017-05-22 23:27:52 --> Model Class Initialized
INFO - 2017-05-22 23:27:52 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:27:52 --> File loaded: C:\wamp\www\online_booking\application\views\add_edit_bookings.php
INFO - 2017-05-22 23:27:52 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:27:52 --> Final output sent to browser
DEBUG - 2017-05-22 23:27:52 --> Total execution time: 0.8033
INFO - 2017-05-22 23:28:36 --> Config Class Initialized
INFO - 2017-05-22 23:28:36 --> Hooks Class Initialized
DEBUG - 2017-05-22 23:28:36 --> UTF-8 Support Enabled
INFO - 2017-05-22 23:28:36 --> Utf8 Class Initialized
INFO - 2017-05-22 23:28:36 --> URI Class Initialized
INFO - 2017-05-22 23:28:36 --> Router Class Initialized
INFO - 2017-05-22 23:28:36 --> Output Class Initialized
INFO - 2017-05-22 23:28:36 --> Security Class Initialized
DEBUG - 2017-05-22 23:28:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2017-05-22 23:28:36 --> Input Class Initialized
INFO - 2017-05-22 23:28:36 --> Language Class Initialized
INFO - 2017-05-22 23:28:36 --> Loader Class Initialized
INFO - 2017-05-22 23:28:36 --> Helper loaded: url_helper
INFO - 2017-05-22 23:28:36 --> Helper loaded: file_helper
INFO - 2017-05-22 23:28:36 --> Helper loaded: common_helper
INFO - 2017-05-22 23:28:36 --> Helper loaded: cookie_helper
INFO - 2017-05-22 23:28:36 --> Helper loaded: email_template_helper
INFO - 2017-05-22 23:28:36 --> Helper loaded: message_helper
INFO - 2017-05-22 23:28:36 --> Database Driver Class Initialized
INFO - 2017-05-22 23:28:36 --> Session: Class initialized using 'files' driver.
INFO - 2017-05-22 23:28:36 --> Helper loaded: form_helper
INFO - 2017-05-22 23:28:36 --> Form Validation Class Initialized
INFO - 2017-05-22 23:28:36 --> Controller Class Initialized
INFO - 2017-05-22 23:28:36 --> Model Class Initialized
INFO - 2017-05-22 23:28:36 --> Model Class Initialized
INFO - 2017-05-22 23:28:36 --> File loaded: C:\wamp\www\online_booking\application\views\include/header.php
INFO - 2017-05-22 23:28:36 --> File loaded: C:\wamp\www\online_booking\application\views\add_edit_bookings.php
INFO - 2017-05-22 23:28:36 --> File loaded: C:\wamp\www\online_booking\application\views\include/footer.php
INFO - 2017-05-22 23:28:37 --> Final output sent to browser
DEBUG - 2017-05-22 23:28:37 --> Total execution time: 0.6798
