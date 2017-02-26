<?php

function plugin_init_mod() {
  
   global $PLUGIN_HOOKS, $LANG ;
             
   $PLUGIN_HOOKS['csrf_compliant']['mod'] = true;   
      
   //$PLUGIN_HOOKS['config_page']['mod'] = 'front/config.php';
                
}


function plugin_version_mod(){
	global $DB, $LANG;

	return array('name'			=> __('GLPI Modifications'),
					'version' 			=> '1.0.3',
					'author'			   => '<a href="mailto:stevenesdonato@gmail.com"> Stevenes Donato </b> </a>',
					'license'		 	=> 'GPLv2+',
					'homepage'			=> 'https://forge.glpi-project.org/projects/mod',
					'minGlpiVersion'	=> '9.1.2');
}

function plugin_mod_check_prerequisites(){
        if (GLPI_VERSION == '9.1.2'){
                return true;
        } else {
                echo "GLPI version not compatible need 9.1.2";
        }
}


function plugin_mod_check_config($verbose=false){
	if ($verbose) {
		echo 'Installed / not configured';
	}
	return true;
}


?>
