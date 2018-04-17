<?php

include_once (GLPI_ROOT."/inc/based_config.php");

if (!defined("GLPI_MOD_DIR")) {
   define("GLPI_MOD_DIR", GLPI_ROOT."/plugins/mod");
}

//without plugin
if(!is_file(GLPI_ROOT.'/index.php.bak')) {
	
	rename(GLPI_ROOT.'/index.php', GLPI_ROOT.'/index.php.bak');
	copy(GLPI_MOD_DIR.'/src/index.php', GLPI_ROOT.'/index.php');

	rename(GLPI_ROOT.'/front/login.php', GLPI_ROOT.'/front/login.php.bak');
	copy(GLPI_MOD_DIR.'/src/login.php', GLPI_ROOT.'/front/login.php');	
	
	rename(GLPI_ROOT.'/script.js', GLPI_ROOT.'/script.js.bak');
	copy(GLPI_MOD_DIR.'/src/script.js', GLPI_ROOT.'/script.js');
	
	//css
	rename(GLPI_ROOT.'/css', GLPI_ROOT.'/css.bak');
	exec('cp -r '.GLPI_MOD_DIR.'/src/css '.GLPI_ROOT.'/');
	
	//font awesome
	exec('cp -r '.GLPI_MOD_DIR.'/src/fonts '.GLPI_ROOT.'/');
	
	//images
	//rename(GLPI_ROOT.'/pics/favicon.ico', GLPI_ROOT.'/pics/favicon.ico.bak');
	rename(GLPI_ROOT.'/pics/login_logo_glpi.png', GLPI_ROOT.'/pics/login_logo_glpi.png.bak');
	rename(GLPI_ROOT.'/pics/logo-glpi-login.png', GLPI_ROOT.'/pics/logo-glpi-login.png.bak');
	exec('cp '.GLPI_ROOT.'/pics/fd_logo.png '.GLPI_ROOT.'/pics/fd_logo.png.bak');

	exec('cp '.GLPI_MOD_DIR.'/src/pics/*.png '.GLPI_ROOT.'/pics');
	exec('cp '.GLPI_MOD_DIR.'/src/pics/*.ico '.GLPI_ROOT.'/pics');
	exec('cp -r '.GLPI_MOD_DIR.'/src/pics/bg '.GLPI_ROOT.'/pics');
		
	//exec('service apache2 reload');

}

else {

	//update plugin
	exec('cp '.GLPI_MOD_DIR.'/src/index.php '.GLPI_ROOT.'/index.php');
	exec('cp '.GLPI_MOD_DIR.'/src/css/js/*.js '.GLPI_ROOT.'/css/js/');
	exec('cp '.GLPI_MOD_DIR.'/src/css/ie.css '.GLPI_ROOT.'/css/ie.css');
	exec('cp '.GLPI_MOD_DIR.'/src/css/style.css '.GLPI_ROOT.'/css/style.css');
	exec('cp '.GLPI_MOD_DIR.'/src/css/styles.css '.GLPI_ROOT.'/css/styles.css');
	exec('cp '.GLPI_MOD_DIR.'/src/pics/logo_big-def.png '.GLPI_ROOT.'/pics/');
	exec('cp -r '.GLPI_MOD_DIR.'/src/pics/bg '.GLPI_ROOT.'/pics');
   exec('cp '.GLPI_ROOT.'/pics/fd_logo.png '.GLPI_ROOT.'/pics/fd_logo.png.bak');

	if(is_file(GLPI_ROOT.'/inc/html.class.php.bak')) {	

		rename(GLPI_ROOT.'/inc/commonglpi.class.php.bak', GLPI_ROOT.'/inc/commonglpi.class.php');		
		rename(GLPI_ROOT.'/inc/html.class.php.bak', GLPI_ROOT.'/inc/html.class.php');		
		rename(GLPI_ROOT.'/inc/search.class.php.bak', GLPI_ROOT.'/inc/search.class.php');
	}
	
	//exec('service apache2 reload');
	
}	

?>