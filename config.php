<?php

include ("../../inc/includes.php");
include ("../../inc/config.php");

if (!defined("GLPI_MOD_DIR")) {
   define("GLPI_MOD_DIR", GLPI_ROOT."/plugins/mod");
}

$plugin = new Plugin();

function imgBack(){
	copy(GLPI_ROOT.'/pics/bg/back-def.jpg',GLPI_ROOT.'/pics/bg/back.jpg');
}

function imgLogo(){	
	copy(GLPI_ROOT.'/pics/logo_big-def.png',GLPI_ROOT.'/pics/logo_big.png');
}

function imgLogo_int(){	
	copy(GLPI_ROOT.'/pics/bg/fd_logo-def.png',GLPI_ROOT.'/pics/fd_logo.png');
}

function indexMod(){
	copy(GLPI_ROOT.'/index.php',GLPI_ROOT.'/index.php.bak');
	copy('./src/index.php',GLPI_ROOT.'/index.php');
}

function indexDef(){
	copy(GLPI_ROOT.'/index.php.bak',GLPI_ROOT.'/index.php');
}


function staOff(){
	rename(GLPI_MOD_DIR.'/scripts/stats.js', GLPI_MOD_DIR.'/scripts/stats.js.bak');
}

function staOn(){
	rename(GLPI_MOD_DIR.'/scripts/stats.js.bak', GLPI_MOD_DIR.'/scripts/stats.js');
}


function indOff(){
	rename(GLPI_MOD_DIR.'/scripts/ind.js', GLPI_MOD_DIR.'/scripts/ind.js.bak');		
}

function indOn(){
	rename(GLPI_MOD_DIR.'/scripts/ind.js.bak', GLPI_MOD_DIR.'/scripts/ind.js');
}



if ($plugin->isActivated("mod")) {

	if(isset($_REQUEST['act'])) {
		$action = $_REQUEST['act'];
	}
	else { $action = '';}

   Html::header('Plugin Modifications', "", "plugins", "mod");	      
		  
	echo "<div class='center' style='height:900px; width:80%; background:#fff; margin:auto; float:none;'><br><p>\n";
   echo "<div id='config' class='center here ui-tabs-panel'>
   			<br><p>
        		<span style='color:blue; font-weight:bold; font-size:13pt;'>".__('Plugin Modifications')."</span> <br><br><p>\n";
	
	// Index page
	echo "<table class='tab_cadrehov' border='0'>
			<tbody>\n";										
	echo "<tr>
				<td colspan='5' width='100'>".__('Index Page').": </td></tr>\n";

	echo "	<tr>
					<td width='50'>".__('Default').":</td>
					<td width='100'>
					<form action='config.php?act=def' method='post'> ";
				   	if ($action == 'def') {
        			 		indexDef();						
    				 	}
	echo "			<input class='submit' type='submit' value='".__('Send')."' />";
					Html::closeForm(); 
	echo "	</td>\n";
	
	echo "	<td width='50'>".__('Mod').":</td>
				<td width='200'>
					<form action='config.php?act=mod' method='post'> ";
				   	if ($action == 'mod') {
        			 		indexMod();						
    				 	}
	echo "			<input class='submit' type='submit' value='".__('Send')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>\n";			
	echo "</tbody></table>\n";		


	// Indicators
	echo "<table class='tab_cadrehov' border='0'>
			<tbody>\n";										
	echo "<tr>
				<td colspan='1' width='70'>".__('Indicators').": </td>\n";
	echo "				
				<td width='50'>
					<form action='config.php?act=indon' method='post'> ";
				   	if ($action == 'indon') {
        			 		indOn();						
    				 	}
	echo "			<input class='submit' type='submit' value='"._x('button','Enable')."' />";
					Html::closeForm(); 
	echo "	</td>\n";
	
	echo "	<td width='200'>
					<form action='config.php?act=indoff' method='post'> ";
				   	if ($action == 'indoff') {
        			 		indOff();						
    				 	}
	echo "			<input class='submit' type='submit' value='".__('Disable')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>\n";	
			
	//Stats
	echo "<tr>
				<td colspan='1' width='70'>".__('Stats bar').": </td>\n";
	echo "				
				<td width='50'>
					<form action='config.php?act=staon' method='post'> ";
				   	if ($action == 'staon') {
        			 		staOn();						
    				 	}
	echo "			<input class='submit' type='submit' value='"._x('button','Enable')."' />";
					Html::closeForm(); 
	echo "	</td>\n";
	
	echo "	<td width='200'>
					<form action='config.php?act=staoff' method='post'> ";
				   	if ($action == 'staoff') {
        			 		staOff();						
    				 	}
	echo "			<input class='submit' type='submit' value='".__('Disable')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>\n";				
	echo "</tbody></table>\n";		

	// Background
	echo "<table class='tab_cadrehov' border='0'>
			<tbody>\n";		
	echo "<tr>
				<td colspan='5'>Background: </td> 
			</tr>\n";
	echo "<tr>				
				<td width='210'> <img src='../../pics/bg/back.jpg?v=".Date("Y.m.d.G.i.s")." width='180' height='130' /> </td>
				<td width='100'>".__('Upload').":</td>
				<td>
					<form action='upfile.php' method='post' enctype='multipart/form-data' class='fileupload'>
						<input type='file' name='photo' size='25' /><p><br>
						<input class='submit' type='submit' name='submit' value='".__('Send')."' />";
					Html::closeForm(); 
	echo "	</td>
				<td>
					<form action='config.php?act=back' method='post'> ";
					    if ($action == 'back') {
        				 	imgBack();						
    					 }
	echo "		<input class='submit' type='submit' value='".__('Default')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>\n";
	// Background		
			
	// Logo index		
	echo "<tr><td colspan='5'></td></tr>
			<tr>
				<td colspan='5'>Logo - Index (png 150 X 150px): </td> 
			</tr>\n";
			
	echo "<tr>				
				<td width='210'> <img src='../../pics/logo_big.png?v=".Date("Y.m.d.G.i.s")." width='180' height='130' /> </td>
				<td width='100'>".__('Upload').":</td>
				<td>
					<form action='uplogo.php' method='post' enctype='multipart/form-data' class='fileupload'>
						<input type='file' name='photo' size='25' /><p><br>
						<input class='submit' type='submit' name='submit' value='".__('Send')."' />";
					Html::closeForm(); 
	echo "	</td>
				<td>
					<form action='config.php?act=logo' method='post'> ";
					    if ($action == 'logo') {
        				 	imgLogo();						
    					 }
	echo "		<input class='submit' type='submit' value='".__('Default')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>\n";
	// Logo index		
	
  // Logo internal 100x55		
	echo "<tr><td colspan='5'></td></tr>
			<tr>
				<td colspan='5'>Logo (png 100 X 55px): </td> 
			</tr>\n";
			
	echo "<tr>				
				<td width='210' style='background:#f2f2f2;'> <img src='../../pics/fd_logo.png?v=".Date("Y.m.d.G.i.s")." height='100' /> </td>
				<td width='100'>".__('Upload').":</td>
				<td>
					<form action='uplogo_int.php' method='post' enctype='multipart/form-data' class='fileupload'>
						<input type='file' name='photo2' size='25' /><p><br>
						<input class='submit' type='submit' name='submit' value='".__('Send')."' />";
					Html::closeForm(); 
	echo "	</td>
				<td>
					<form action='config.php?act=logo_int' method='post'> ";
					    if ($action == 'logo_int') {
        				 	imgLogo_int();						
    					 }
	echo "		<input class='submit' type='submit' value='".__('Default')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>\n";
	// Logo internal	
		
	echo "</tbody></table>\n";
                
	echo "		<div id='back' class='center' style='margin-top:30px;'>
						<a class='vsubmit' type='submit' onclick=\"window.location.href = '". $CFG_GLPI['root_doc'] ."/front/plugin.php';\" >  ".__('Back')." </a> 
					</div>
				</div>
			</div>\n";
}

?>
