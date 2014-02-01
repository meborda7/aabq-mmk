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

define('APP_NAME', 'NightJar');

/* encoding */
define('PASSWORD_ENCODING',						'sha256');

/* TABLES */
define('TABLE_CLIENT', 							'client');
define('TABLE_PROF_SERVICES',					'prof_services');
define('TABLE_CLIENT_SERVICES',					'client_services');
define('TABLE_FILE',							'file');

/* MODELS */
define('MODEL_CLIENT', 							'ClientModel');
define('MODEL_PROF_SERVICES', 					'ProfServicesModel');
define('MODEL_CLIENT_SERVICES', 				'ClientServiceModel');
define('MODEL_FILE',			 				'FileModel');

/* JOIN */
define('TABLE',									'table');
define('COLUMNS',								'column');
define('JOIN_TYPE',								'TYPE');
define('JOIN_LEFT',								'left');
define('JOIN_RIGHT',							'right');

/* COLUMNS */
define('ROW_ID',						'id');
define('RESULT',						'result');
define('ERROR', 						'error');
define('ERROR_MSG', 					'Empty or invalid value.');


/* End of file constants.php */
/* Location: ./application/config/constants.php */