<?php

function plugin_mod_install(){
		
	include('install.php');        	
	return true;
}

function plugin_mod_uninstall(){
		
	include('uninstall.php');
	return true;
}

?>
