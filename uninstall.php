<?php

include_once (GLPI_ROOT."/inc/based_config.php");

if (!defined("GLPI_MOD_DIR")) {
   define("GLPI_MOD_DIR", GLPI_ROOT . "/plugins/mod");
}


function deleteAll($str) {
    //It it's a file.
    if (is_file($str)) {
        //Attempt to delete it.
        return unlink($str);
    }
    //If it's a directory.
    elseif (is_dir($str)) {
        //Get a list of the files in this directory.
        $scan = glob(rtrim($str,'/').'/*');
        //Loop through the list of files.
        foreach($scan as $index=>$path) {
            //Call our recursive function.
            deleteAll($path);
        }
        //Remove the directory itself.
        return @rmdir($str);
    }
}

//call our function
//deleteAll('temporary_files');


if(is_file(GLPI_ROOT.'/index.php.bak')) {
		
	//exec('rm '.GLPI_ROOT.'/index.php');
	array_map('unlink', array_filter((array) glob("/index.php")));
	rename(GLPI_ROOT.'/index.php.bak', GLPI_ROOT.'/index.php');

//	exec('rm '.GLPI_ROOT.'/front/login.php');
	array_map('unlink', array_filter((array) glob("/front/login.php")));
	rename(GLPI_ROOT.'/front/login.php.bak', GLPI_ROOT.'/front/login.php');
	
//	exec('rm '.GLPI_ROOT.'/script.js');
	array_map('unlink', array_filter((array) glob("/script.js")));
	rename(GLPI_ROOT.'/script.js.bak', GLPI_ROOT.'/script.js');
	
//	exec('rm -r '.GLPI_ROOT.'/css');
	deleteAll(GLPI_ROOT.'/css');
	rename(GLPI_ROOT.'/css.bak', GLPI_ROOT.'/css');
	
//	exec('rm '.GLPI_ROOT.'/pics/fd_logo.png');
	array_map('unlink', array_filter((array) glob(GLPI_ROOT.'/pics/fd_logo.png')));
   rename(GLPI_ROOT.'/pics/fd_logo.png.bak', GLPI_ROOT.'/pics/fd_logo.png');
	//copy('../../pics/fd_logo.png.bak','../../pics/fd_logo.png');
	
	//exec('rm -r '.GLPI_ROOT.'/fonts');	
//	exec('rm '.GLPI_ROOT.'/pics/favicon.ico');
	array_map('unlink', array_filter((array) glob(GLPI_ROOT.'/pics/favicon.ico')));
	array_map('unlink', array_filter((array) glob(GLPI_ROOT.'/pics/login_logo_glpi.png')));
	array_map('unlink', array_filter((array) glob(GLPI_ROOT.'/pics/logo-glpi-login.png')));
	array_map('unlink', array_filter((array) glob(GLPI_ROOT.'/pics/logo.png')));
	array_map('unlink', array_filter((array) glob(GLPI_ROOT.'/pics/logo_big.png')));
	array_map('unlink', array_filter((array) glob(GLPI_ROOT.'/pics/logo_big-def.png')));
	deleteAll(GLPI_ROOT.'/pics/bg');
	
	rename(GLPI_ROOT.'/pics/favicon.ico.bak', GLPI_ROOT.'/pics/favicon.ico');
	rename(GLPI_ROOT.'/pics/login_logo_glpi.png.bak', GLPI_ROOT.'/pics/login_logo_glpi.png');
	rename(GLPI_ROOT.'/pics/logo-glpi-login.png.bak', GLPI_ROOT.'/pics/logo-glpi-login.png');
	
	if(is_file(GLPI_ROOT.'/inc/search.class.php.bak')) {		
		rename(GLPI_ROOT.'/inc/search.class.php.bak', GLPI_ROOT.'/inc/search.class.php');
	}

	if(is_file(GLPI_ROOT.'/inc/auth.class.php.bak')) {		
		rename(GLPI_ROOT.'/inc/auth.class.php.bak', GLPI_ROOT.'/inc/auth.class.php');
	}

}


?>
