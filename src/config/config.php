<?php
//timezone
date_default_timezone_set('America/Manaus');

//language, setlocale
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

//export model, folder
define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));

//export database
require_once(realpath(dirname(__FILE__) . '/database.php'));