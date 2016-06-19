<?php 
/*
*
* APPLICATION ENVIRONMENT FILE
*
* You can load different configurations depending on your
* current environment. Setting the environment also influences
* things like logging and error reporting.
*
* This can be set to anything, but default usage is:
*
*     development
*     testing
*     production
*
* NOTE: If you change these, also change the error_reporting() code below
*
*/
define('DEVELOPMENT', 'development');
define('STAGING', 'staging');
define('PRODUCTION', 'production');

/*
 * Current environment of the application
 */
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : DEVELOPMENT);


/*
*---------------------------------------------------------------
* ERROR REPORTING
*---------------------------------------------------------------
*
* Different environments will require different levels of error reporting.
* By default development will show errors but testing and live will hide them.
*/


/* End of file environment.php */
/* Location: ./application/config/environment.php */
