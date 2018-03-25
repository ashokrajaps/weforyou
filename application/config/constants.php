<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* custon  values */

/* URL settings  */
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off' || $_SERVER['SERVER_PORT']==443) ? "https" : "http";
define('BASE_URL', "$protocol://$_SERVER[SERVER_NAME]/" );
define('media_image_url', BASE_URL.'media/images/' );
/*  Length */
define('PASSWORD_LENGTH',6);
define('PERMISSION_MODULE_ID',14);

/* API  related  URL  */
define('API_BASE_URL',BASE_URL."api/");

define('causes_list_limit','4');
define('event_list_limit','6');
define('image_max_size','3072');
define('video_max_size','3072');

define('donation_max_width',270);
define('donation_max_height',201);

define('volunteer_max_width',270);
define('volunteer_max_height',201);

define('causes_max_width',226);
define('causes_max_height',221);

define('event_max_width',226);
define('event_max_height',221);

define('paypal_business_email','ranjithkumar.r-facilitator_api1.ajaxmediatech.com');
define('payumoney_merchant_id','2vKOAJXg');
define('payumoney_key','2vKOAJXg');
define('payumoney_salt','CeXHPWYpCR');


define('image_allowed_types','gif|jpg|jpeg|pjpeg|x-png|png');
define('video_allowed_types','gif|jpg|jpeg|pjpeg|x-png|png');
define('doc_allowed_types','gif|jpg|jpeg|pjpeg|x-png|png');

define('volunteer_upload_path',FCPATH.'media/volunteer/');
define('causes_upload_path',FCPATH.'media/causes/');
define('event_upload_path',FCPATH.'media/event/');
define('donar_upload_path',FCPATH.'media/donar/');
define('slider_upload_path',FCPATH.'media/slider/');

define('volunteer_path',BASE_URL.'media/volunteer/');
define('causes_path',BASE_URL.'media/causes/');
define('event_path',BASE_URL.'media/event/');
define('donar_path',BASE_URL.'media/donar/');
define('slider_path',BASE_URL.'media/slider/');
define('donation_bg_image_path',BASE_URL.'media/donate/');

