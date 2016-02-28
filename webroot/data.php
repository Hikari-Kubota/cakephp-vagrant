<?php
require_once('db_func.php');
$link = db_connect();

if(isset($_POST['mode'])){
	$mode = $_POST['mode'];
	$data = $_POST['data'];
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

<form action="procedure.php" method="post">
ID：<input type="text" name="id" size="15" disabled="true">
最終更新日：<input type="text" name="updated" size="15" disabled="true"><br>

姓：<input type="text" name="last_name" size="15">
姓（かな）：<input type="text" name="last_name_kana" size="15"><br>

名：<input type="text" name="first_name" size="15">
名（かな）：<input type="text" name="first_name_kana" size="15"><br>

郵便番号：<input type="text" name="post1" size="3"> - <input type="text" name="post2" size="4"><br>
住所：<input type="text" name="address" size="40"><br>

<input type="submit" name="mode" value=<?php print($mode); ?>>
</form>

</body>
</html>

<?php db_close($link); ?>