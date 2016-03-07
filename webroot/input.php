<?php
require_once('db_func.php');
$pdo = db_connect();

if(!isset($_POST['mode'])){
	die('Could not find any modes.');
}

$mode = $_POST['mode'];

/*$data = array(
			"id" => "", "updated" = "",
            "first_name" => "", "last_name" => "",
            "first_name_kana" => "", "last_name_kana" => "",
            "post1" => "", "post2" => "",
            "address" => "",
            );*/

if($_POST['mode']=="更新"){
	$sql = "SELECT * FROM list WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array("id" => $_POST['id']));
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
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

<form action="index.php" method="post">
ID：<input type="text" name="id" size="15" disabled="true" value=<?php echo $res['id']; ?>>
最終更新日：<input type="text" name="updated" size="15" disabled="true"  value=<?php echo $res['updated']; ?>><br>

姓：<input type="text" name="last_name" size="15"  value=<?php echo $res['last_name']; ?>>
姓（かな）：<input type="text" name="last_name_kana" size="15"  value=<?php echo $res['last_name_kana']; ?>><br>

名：<input type="text" name="first_name" size="15"  value=<?php echo $res['first_name']; ?>>
名（かな）：<input type="text" name="first_name_kana" size="15"  value=<?php echo $res['first_name_kana']; ?>><br>

郵便番号：<input type="text" name="post1" size="3"  value=<?php echo $res['post1']; ?>> - <input type="text" name="post2" size="4"  value=<?php echo $res['post2']; ?>><br>
住所：<input type="text" name="address" size="40"  value=<?php echo $res['address']; ?>><br>

<input type="submit" name="mode" value=<?php print($mode); ?>>
</form>

</body>
</html>