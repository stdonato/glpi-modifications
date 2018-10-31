<?php
/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2017 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */


/** @file
* @brief
*/

// Modified by Stevenes Donato
// stevenesdonato@gmail.com

// Check PHP version not to have trouble
// Need to be the very fist step before any include
if (version_compare(PHP_VERSION, '5.6') < 0) {
   die('PHP >= 5.6 required');
}

use Glpi\Event;

//Load GLPI constants
define('GLPI_ROOT', __DIR__);
include (GLPI_ROOT . "/inc/based_config.php");
include_once (GLPI_ROOT . "/inc/define.php");

// Check PHP version not to have trouble
if (version_compare(PHP_VERSION, GLPI_MIN_PHP) < 0) {
   die(sprintf("PHP >= %s required", GLPI_MIN_PHP));
}

define('DO_NOT_CHECK_HTTP_REFERER', 1);

// If config_db doesn't exist -> start installation
if (!file_exists(GLPI_CONFIG_DIR . "/config_db.php")) {
   include_once (GLPI_ROOT . "/inc/autoload.function.php");
   Html::redirect("install/install.php");
   die();

} else {
   $TRY_OLD_CONFIG_FIRST = true;
   include (GLPI_ROOT . "/inc/includes.php");
   $_SESSION["glpicookietest"] = 'testcookie';

   // For compatibility reason
   if (isset($_GET["noCAS"])) {
      $_GET["noAUTO"] = $_GET["noCAS"];
   }

   if (!isset($_GET["noAUTO"])) {
      Auth::redirectIfAuthenticated();
   }

   Auth::checkAlternateAuthSystems(true, isset($_GET["redirect"])?$_GET["redirect"]:"");
   
   $_SESSION['namfield'] = $namfield = uniqid('fielda');
   $_SESSION['pwdfield'] = $pwdfield = uniqid('fieldb');
   $_SESSION['rmbfield'] = $rmbfield = uniqid('fieldc');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">    
	<title><?php echo __('GLPI - Authentication'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
	<link rel="icon" href="pics/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.css" rel="stylesheet">    
	<link href="css/css.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	
	<!--[if IE]>
  <script src="css/js/html5shiv.min.js"></script>
  <script src="css/js/respond.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/ie.css" />
	<![endif]-->
	
	<script type='text/javascript'>      
		window.onload = function() {
		  			var input = document.getElementById("login_name").focus();
			}      
	</script>
    
	 <script src="lib/jquery/js/jquery-1.10.2.min.js"></script>
    <script src="css/js/bootstrap.js"></script> 

	<style type="text/css">
		html, body {			
			height: 100%;	
			font-family: 'Open Sans', sans-serif;
			font-weight: 100;	
			color: #424a4d;	
			background:  url("./pics/bg/back.jpg") repeat-x fixed;  
			background-size:1925px 1200px;		
			width: 100%; 
		}
			  
		video#bgvid { 		
			position: fixed; right: 0; bottom: 0;		
			min-width: 100%; min-height: 100%;		
			width: auto; height: auto; z-index: -900;		
			background: url(cloud.png) no-repeat;		
			background-size: cover; 		
		}
		
		#dropdown_auth1 {
			width: 100%; 
			height: 32px; 
			color:#333;
			padding-left: 10px;				
		}
		
	</style>      
    
</head>
<body>

<div class="container">  

	<video autoplay loop poster="cloud.png" id="bgvid" style="z-index:-999; position:absolute;">
		<!--- <source src="./pics/vids/bg.mp4x" type="video/mp4"> -->
	</video>         

    <div class="row login">
		  	<div id='text-login' class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
		  		<?php echo nl2br(Toolbox::unclean_html_cross_side_scripting_deep($CFG_GLPI['text_login'])); ?>  
		  	</div>
	      <div class="head col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
	      	<h3 class="text-center"><img class="logo-img" src="pics/logo.png" alt="" style="height:50px;"></h3>
	      </div>

        <div id="login-body" class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">

            <form role="form" action='front/login.php' method='post'>
					<?php
				   // Other CAS
				   if (isset($_GET["noAUTO"])) {
				      echo "<input type='hidden' name='noAUTO' value='1'/>";
				   }
				
				   // redirect to ticket
				   if (isset($_GET["redirect"])) {
				      Toolbox::manageRedirect($_GET["redirect"]);
				      echo '<input type="hidden" name="redirect" value="'.$_GET['redirect'].'">';
				   }
					?>              
            
              <div class="form-group text-center">
                <div class="logo">
						<img src="pics/logo_big.png" alt="GLPI" class="logo2" height="150" />
                </div>
              </div>
              <div class="form-group">
                  <input class="form-control input-md" name="<?php echo $namfield; ?>" id="login_name" required="required" placeholder="<?php echo __('User') ?>" type="text">
              </div>
              <div class="form-group">
                  <input class="form-control input-md" name="<?php echo $pwdfield; ?>" id="login_password" required="required" placeholder="<?php echo __('Password') ?>" type="password">
              </div>
              
				  <?php         
               //entity select
					$sql_ent = "SELECT COUNT(id) AS conta FROM glpi_entities";
					$result_ent = $DB->query($sql_ent);
					$conta = $DB->fetch_assoc($result_ent);
				
					if($conta['conta'] >= 2) {
						
						$sql_ent = "SELECT id, name FROM glpi_entities WHERE 1";
						$result_ent = $DB->query($sql_ent);
					
						echo '<p class="login_input">
						<select class="form-control" required name="active_entity" id="active_entity" style="width: 100%; height: 32px; color:#333" placeholder="'. __('Select the desired entity') .'">
						<!--<option value="" disabled selected hidden></option>
					   <option value=""></option>-->
					   ';
					   
					   //$DB->data_seek($result_ent, 0);
						while ($row = $DB->fetch_assoc($result_ent))		
						{ 
							echo "<option value=".$row['id'].">".$row['name']."</option>\n";		
						}    
					
						echo '</select></p>'; 
				   }    
				   //entity select

					 echo '<p class="login_input">';     
					 // Add dropdown for auth (local, LDAPxxx, LDAPyyy, imap...)
					 Auth::dropdownLogin();   
					 echo '</p>';
				  ?>              
				  <?php 
				  	if ($CFG_GLPI["login_remember_time"]) {
				   echo '<p class="login_input">
				         <label for="login_remember">
				                <input type="checkbox" name="'.$rmbfield.'" id="login_remember"
				                '.($CFG_GLPI['login_remember_default']?'checked="checked"':'').' />
				         '.__('Remember me').'</label>
				         </p>';
					}
					?>
              <div class="form-group">
                <button type="submit" class="btn btn-default btn-lg btn-block btn-primary"><?php echo _sx('button','Post'); ?></button>
              </div>
              <div class="form-group last-row">

              <div class="out-linksx">
				    <a href="#">
					   <?php
					    // Display FAQ is enable
					   if ($CFG_GLPI["use_public_faq"]) {
					      echo '<div id="xbox-faqx" style="float:left;" >'.
					            '<a style="color:#757575;" href="front/helpdesk.faq.php"> '.__('Access to the Frequently Asked Questions').' ';
					      echo "</a></div>\n";
					   }
					   ?>
				    </a>
			    </div>
	            <?php
					    if ($CFG_GLPI["use_mailing"] && countElementsInTable('glpi_notifications', "`itemtype`='User' AND `event`='passwordforget' AND `is_active`=1")) {
					      echo '<div class="pull-right"><a href="front/lostpassword.php?lostpassword=1">'.__('Forgotten password?').'</a></div>';
					   }				            			          				
					?>  
                
              </div>
<!--            </form>-->
      		<?php
					Html::closeForm();
				?>
        </div>
    </div>

	<?php
	  echo "</div>"; // end contenu login
	
	   if (GLPI_DEMO_MODE) {
	      echo "<div class='center'>";
	      Event::getCountLogin();
	      echo "</div>";
	   }

	   echo "<div id='footer-login'>\n";
	   echo "<a href='http://glpi-project.org/' title='Powered By Teclib' style='color:#fff;'>";
	   echo "GLPI Copyright (C) 2015 - ".date('Y')." Teclib and contributors - Copyright (C) 2003 - 2015 INDEPNET Development Team";
	   echo "</a></div>\n"; 
	?>       
        
</div>
<script type="text/javascript">

</script>
</body>
</html>
