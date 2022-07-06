<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/* USER DEFINED CONSTANTS */

define('APP_NAME','AssessmentHouse');
define('APP_NAME_TEAM','AssessmentHouse Team');
define('POWERED_BY','MJ ');
define('POWERED_BY_FULL','Meenesh Jain');
define('COMPANY_URL','http://ahonline.co');
define('ADMIN_EMAIL', 'booking@ahonline.co');

date_default_timezone_set('Africa/Johannesburg');
define('TIME',date('H:i:s'));
define('TIMESTAMP',strtotime(date('Y-m-d H:i:s')));
define('DATE',date('Y-m-d'));
define('DATETIME',date('Y-m-d H:i:s'));
define('STOP_SYSTEM_MAILS',0);
define('FROM_EMAIL', 'booking@ahonline.co');
define('DO_NO_CACHE',strtotime(date('Y-m-d H:i:s')));

define('UPLOAD_PDF', 'uploads/pdf/');