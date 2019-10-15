<?php

include_once (GLPI_ROOT."/inc/based_config.php");

if (!defined("GLPI_MOD_DIR")) {
   define("GLPI_MOD_DIR", GLPI_ROOT."/plugins/mod");
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
}

//without plugin
if(!is_file(GLPI_ROOT.'/index.php.bak')) {
	
	rename(GLPI_ROOT.'/index.php', GLPI_ROOT.'/index.php.bak');
	copy(GLPI_MOD_DIR.'/src/index.php', GLPI_ROOT.'/index.php');

	rename(GLPI_ROOT.'/front/login.php', GLPI_ROOT.'/front/login.php.bak');
	copy(GLPI_MOD_DIR.'/src/front/login.php', GLPI_ROOT.'/front/login.php');	
	
	rename(GLPI_ROOT.'/script.js', GLPI_ROOT.'/script.js.bak');
	copy(GLPI_MOD_DIR.'/src/script.js', GLPI_ROOT.'/script.js');
	
	//css
	rename(GLPI_ROOT.'/css', GLPI_ROOT.'/css.bak');
	recurse_copy(GLPI_MOD_DIR.'/src/css/', GLPI_ROOT.'/css/');
	
	//font awesome
	recurse_copy(GLPI_MOD_DIR.'/src/fonts/', GLPI_ROOT.'/fonts/');
	
	//images
	rename(GLPI_ROOT.'/pics/favicon.ico', GLPI_ROOT.'/pics/favicon.ico.bak');
	rename(GLPI_ROOT.'/pics/login_logo_glpi.png', GLPI_ROOT.'/pics/login_logo_glpi.png.bak');
	rename(GLPI_ROOT.'/pics/logo-glpi-login.png', GLPI_ROOT.'/pics/logo-glpi-login.png.bak');
	copy(GLPI_ROOT.'/pics/fd_logo.png', GLPI_ROOT.'/pics/fd_logo.png.bak');

	recurse_copy(GLPI_MOD_DIR.'/src/pics/', GLPI_ROOT.'/pics/');
	
	rename(GLPI_ROOT.'/inc/search.class.php', GLPI_ROOT.'/inc/search.class.php.bak');
	copy(GLPI_MOD_DIR.'/src/inc/search.class.php', GLPI_ROOT.'/inc/search.class.php');
	
	rename(GLPI_ROOT.'/inc/auth.class.php', GLPI_ROOT.'/inc/auth.class.php.bak');
	copy(GLPI_MOD_DIR.'/src/inc/auth.class.php', GLPI_ROOT.'/inc/auth.class.php');		

}

else {

	//update plugin
	copy(GLPI_MOD_DIR.'/src/index.php', GLPI_ROOT.'/index.php');
	copy(GLPI_MOD_DIR.'/src/css/ie.css', GLPI_ROOT.'/css/ie.css');
	copy(GLPI_MOD_DIR.'/src/css/style.css', GLPI_ROOT.'/css/style.css');
	copy(GLPI_MOD_DIR.'/src/css/styles.css', GLPI_ROOT.'/css/styles.css');
	copy(GLPI_MOD_DIR.'/src/pics/logo_big-def.png', GLPI_ROOT.'/pics/');
	recurse_copy(GLPI_MOD_DIR.'/src/pics/bg/', GLPI_ROOT.'/pics/bg/');
   recurse_copy(GLPI_MOD_DIR.'/src/css/js/', GLPI_ROOT.'/css/js/');	
}	

?>
