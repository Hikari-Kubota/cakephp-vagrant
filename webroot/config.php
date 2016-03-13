<?php
/* For DB */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'practice');

/* For mode */
define('M_INSERT', 1);
define('M_UPDATE', 2);
define('M_DELETE', 3);
define('M_SEARCH', 4);

$MODE = array(M_INSERT=>"登録", M_UPDATE=>"更新", 
			  M_DELETE=>"削除", M_SEARCH=>"検索");

?>