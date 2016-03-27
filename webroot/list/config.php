<?php
/* For DB */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'practice');

/* For mode */
define('M_DISPLAY', 1);
define('M_INSERT', 2);
define('M_UPDATE', 3);
define('M_DELETE', 4);
define('M_SEARCH', 5);
define('M_FILLFORM', 6);

$MODE = array(M_DISPLAY=>'一覧', M_INSERT=>"登録", M_UPDATE=>"更新", M_DELETE=>"削除", 
	M_SEARCH=>"検索", M_FILLFORM=>"フォームを埋める");

/* Others */
define('N_DISPLAY', 10);

?>