$(document).ready(function() {

   var ajax_baseurl = '../plugins/mod/ajax';
   var path = document.location.pathname;
   // construct url for plugin pages
   if(path.indexOf('plugins/') !== -1) {
      var plugin_path = path.substring(path.indexOf('plugins'));
      var nb_directory = (plugin_path.match(/\//g) || []).length + 1;
      var ajax_baseurl = Array(nb_directory).join("../") + 'plugins/mod/ajax';
   }

   var pluginModDisplay1 = function() {
      // page index
      $("#page").prepend("<tr><td colspan='1' id='mod_inserted'></td></tr>");
      $("#mod_inserted").load(ajax_baseurl + "/display_stats.php");
          
   };

   if (window.location.href.indexOf("central.php") > 0) {
      pluginModDisplay1();
   }

	var pluginModInd = function () {  
		$("#c_preference").append("<span id='load_ind'></span>");     
		$("#c_preference").css("width",'70%');     
		$("#load_ind").before().load(ajax_baseurl + "/display_ind.php"); 
	};
	
	pluginModInd();

});

