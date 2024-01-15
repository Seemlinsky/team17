<?php
//Require needed files
require_once 'includes/config/settings.php';
require_once 'vendor/autoload.php';

$bootstrap = new \System\Bootstrap\WebBootstrap();
echo $bootstrap->render();

?>