<?php

include ("../../inc/includes.php");
include ("../../config/config.php");

$plugin = new Plugin();

function imgBack(){
	copy('../../pics/bg/back-def.jpg','../../pics/bg/back.jpg');
	//header('Location: ../../plugins/mod/config.php ');
}

function imgLogo(){
	copy('../../pics/logo_big-def.png','../../pics/logo_big.png');
}

if ($plugin->isActivated("mod")) {

   Html::header('Plugin Modifications', "", "plugins", "mod");	      
		  
	echo "<div class='center' style='height:700px; width:80%; background:#fff; margin:auto; float:none;'><br><p>\n";
   echo "<div id='config' class='center here ui-tabs-panel'>
   			<br><p>
        		<span style='color:blue; font-weight:bold; font-size:13pt;'>".__('Plugin Modifications')."</span> <br><br><p>\n";
	
	echo "<table class='tab_cadrehov' border='0'>\n
			<tbody>";	

	echo "<tr><td colspan='5'></td></tr>
			<tr>
			<td colspan='5'>"._n('Profile','Profiles',2).": </td> 
			</tr>";

	$query_prof = "
	SELECT id, completename AS name
	FROM `glpi_itilcategories`							
	ORDER BY `name` ASC ";	

	$res_prof = $DB->query($query_prof);			
			
			
	echo "<tr>								
				<td>".__('Exibir nos perfis').":</td>
				<td>\n";
					
	echo "	</td>";

	echo "	</td>
			</tr>";	

	echo "<tr><td colspan='5'></td></tr>\n";							
	
	echo "<tr>
				<td colspan='5'>Background: </td> 
				</tr>";
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
					    if ($_REQUEST['act'] == 'back') {
        				 	imgBack();						
    					 }
	echo "		<input class='submit' type='submit' value='".__('Default')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>";
			
	echo "<tr><td colspan='5'></td></tr>
			<tr>
			<td colspan='5'>Logo (png 200x200px): </td> 
			</tr>";
			
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
					    if ($_REQUEST['act'] == 'logo') {
        				 	imgLogo();						
    					 }
	echo "		<input class='submit' type='submit' value='".__('Default')."' />";
					Html::closeForm(); 
	echo "	</td>
			</tr>";
	//echo "<tr><td></td></tr>\n";
	
	echo "</tbody></table>";
                
	echo "		<div id='back' class='center' style='margin-top:50px;'>
						<a class='vsubmit' type='submit' onclick=\"window.location.href = '". $CFG_GLPI['root_doc'] ."/front/plugin.php';\" >  ".__('Back')." </a> 
					</div>
				</div>
			</div>\n";
}

?>
