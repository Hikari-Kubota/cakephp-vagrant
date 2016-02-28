<?php
require_once('db_func.php');
$link = db_connect();

if(isset($_POST['mode'])){
    $mode = $_POST['mode'];
}else{
    die('Could not find any modes.');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php print($mode); ?>｜名簿管理アプリ</title>
</head>
<body>
<h1><?php print($mode); ?>｜名簿管理アプリ</h1>


</body>
</html>

<?php db_close($link); ?>