<?php
require_once('db_config.php');

function db_connect(){
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	if (!$link) {
    	die('Could not connect '.DB_HOST.'.<br>'.mysql_error());
	}

	if(!mysql_select_db(DB_NAME)) {
        die('Could not use '.DB_NAME.'.<br>'.mysql_error());
    }
 
    return $link;
}

function db_close($link){
	if(!mysql_close($link)){
		die('Couled not close '.DB_HOST.'.');
	}
}
?>