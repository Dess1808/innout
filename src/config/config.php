<?php
//timezone
date_default_timezone_set('America/Manaus');

//language, setlocale
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

// general const
define('DAILY_TIME', 60 * 60 * 8);

//Folders
define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));
define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/templates'));

//Files
require_once(realpath(dirname(__FILE__) . '/database.php'));
require_once(realpath(dirname(__FILE__) . '/loader.php'));
require_once(realpath(dirname(__FILE__) . '/session.php'));
require_once(realpath(dirname(__FILE__) . '/datesUtil.php'));
require_once(realpath(dirname(__FILE__) . '/messageUtil.php'));
require_once(realpath(MODEL_PATH . '/Model.php'));
require_once(realpath(MODEL_PATH . '/User.php'));
require_once(realpath(EXCEPTION_PATH . '/AppException.php'));
require_once(realpath(EXCEPTION_PATH . '/ValidationException.php'));