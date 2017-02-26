<?php

include_once (GLPI_ROOT."/config/based_config.php");

if (!defined("GLPI_MOD_DIR")) {
   define("GLPI_MOD_DIR",GLPI_ROOT . "/plugins/mod");
}

if(!is_file(GLPI_ROOT.'/index.php.bak')) {
	
	rename(GLPI_ROOT.'/index.php', GLPI_ROOT.'/index.php.bak');
	copy(GLPI_MOD_DIR.'/index.php', GLPI_ROOT.'/index.php');
	
	rename(GLPI_ROOT.'/script.js', GLPI_ROOT.'/script.js.bak');
	copy(GLPI_MOD_DIR.'/script.js', GLPI_ROOT.'/script.js');
	
	//css
	rename(GLPI_ROOT.'/css', GLPI_ROOT.'/css.bak');
	exec('cp -r '.GLPI_MOD_DIR.'/css '.GLPI_ROOT.'/');
	
	//font awesome
	exec('cp -r '.GLPI_MOD_DIR.'/fonts '.GLPI_ROOT.'/');
	
	//Indicators and stats bar
	rename(GLPI_ROOT.'/inc/commonglpi.class.php', GLPI_ROOT.'/inc/commonglpi.class.php.bak');
	rename(GLPI_ROOT.'/inc/html.class.php', GLPI_ROOT.'/inc/html.class.php.bak');
	rename(GLPI_ROOT.'/inc/search.class.php', GLPI_ROOT.'/inc/search.class.php.bak');
	
	exec('cp '.GLPI_MOD_DIR.'/inc/*.php '.GLPI_ROOT.'/inc');
	
	//images
	rename(GLPI_ROOT.'/pics/favicon.ico', GLPI_ROOT.'/pics/favicon.ico.bak');
	rename(GLPI_ROOT.'/pics/login_logo_glpi.png', GLPI_ROOT.'/pics/login_logo_glpi.png.bak');
	rename(GLPI_ROOT.'/pics/logo-glpi-login.png', GLPI_ROOT.'/pics/logo-glpi-login.png.bak');
	
	exec('cp '.GLPI_MOD_DIR.'/pics/*.png '.GLPI_ROOT.'/pics');
	exec('cp '.GLPI_MOD_DIR.'/pics/*.jpg '.GLPI_ROOT.'/pics');
	exec('cp '.GLPI_MOD_DIR.'/pics/*.ico '.GLPI_ROOT.'/pics');
	
	
	exec('service apache2 reload');

}

else {

	copy(GLPI_MOD_DIR.'/index.php', GLPI_ROOT.'/index.php');
	exec('cp '.GLPI_MOD_DIR.'/css/js/*.js '.GLPI_ROOT.'/css/js/');
	exec('cp '.GLPI_MOD_DIR.'/css/ie.css '.GLPI_ROOT.'/css/ie.css');
	exec('cp '.GLPI_MOD_DIR.'/css/style.css '.GLPI_ROOT.'/css/style.css');
}	

//1.0.2
if(is_file(GLPI_ROOT.'/script.js.bak')) {
	copy(GLPI_MOD_DIR.'/script.js', GLPI_ROOT.'/script.js');
}		

?>