<?php

include_once (GLPI_ROOT."/config/based_config.php");

if (!defined("GLPI_MOD_DIR")) {
   define("GLPI_MOD_DIR",GLPI_ROOT . "/plugins/mod");
}

if(is_file(GLPI_ROOT.'/index.php.bak')) {
		
	exec('rm '.GLPI_ROOT.'/index.php');
	rename(GLPI_ROOT.'/index.php.bak', GLPI_ROOT.'/index.php');
	
	exec('rm '.GLPI_ROOT.'/script.js');
	rename(GLPI_ROOT.'/script.js.bak', GLPI_ROOT.'/script.js');
	
	exec('rm -r '.GLPI_ROOT.'/css');
	rename(GLPI_ROOT.'/css.bak', GLPI_ROOT.'/css');
	
	exec('rm -r '.GLPI_ROOT.'/fonts');
	
	
	exec('rm '.GLPI_ROOT.'/inc/commonglpi.class.php');
	rename(GLPI_ROOT.'/inc/commonglpi.class.php.bak', GLPI_ROOT.'/inc/commonglpi.class.php');
	
	exec('rm '.GLPI_ROOT.'/inc/html.class.php');
	rename(GLPI_ROOT.'/inc/html.class.php.bak', GLPI_ROOT.'/inc/html.class.php');
	
	exec('rm '.GLPI_ROOT.'/inc/search.class.php');
	rename(GLPI_ROOT.'/inc/search.class.php.bak', GLPI_ROOT.'/inc/search.class.php');
	
	exec('rm '.GLPI_ROOT.'/inc/indicator.inc.php');
	exec('rm '.GLPI_ROOT.'/inc/stats.inc.php');
	
	
	exec('rm '.GLPI_ROOT.'/pics/favicon.ico');
	exec('rm '.GLPI_ROOT.'/pics/login_logo_glpi.png');
	exec('rm '.GLPI_ROOT.'/pics/logo-glpi-login.png');
	exec('rm '.GLPI_ROOT.'/pics/logo.png');
	exec('rm '.GLPI_ROOT.'/pics/logo_big.png');
	exec('rm '.GLPI_ROOT.'/pics/logo_big-def.png');
	exec('rm '.GLPI_ROOT.'/pics/back.jpg');
	exec('rm -r '.GLPI_ROOT.'/pics/bg');
	
	rename(GLPI_ROOT.'/pics/favicon.ico.bak', GLPI_ROOT.'/pics/favicon.ico');
	rename(GLPI_ROOT.'/pics/login_logo_glpi.png.bak', GLPI_ROOT.'/pics/login_logo_glpi.png');
	rename(GLPI_ROOT.'/pics/logo-glpi-login.png.bak', GLPI_ROOT.'/pics/logo-glpi-login.png');
	
	exec('service apache2 reload');

}


?>