<?php
require_once('config.php');
require_once('db_func.php');
$pdo = db_connect();

if(!isset($_POST['mode'])){
	die('Could not find any modes.');
}

$mode = $_POST['mode'];

if($_POST['mode'] == M_UPDATE){
	$sql = "SELECT * FROM list WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array("id" => $_POST['id']));
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript">
    const M_INSERT = <?php print(M_INSERT); ?>;
    const M_UPDATE = <?php print(M_UPDATE); ?>;
    const M_DELETE = <?php print(M_DELETE); ?>;
    const M_SEARCH = <?php print(M_SEARCH); ?>;
</script>
<script type="text/javascript" src="js/script.js"></script>
<title><?php print($MODE[$mode]); ?>｜名簿管理アプリ</title>
</head>
<body>
<div id="wrapper">

<header>
	<h1><?php print($MODE[$mode]); ?>｜名簿管理アプリ</h1>
</header>

<nav>
    <div id="btn_to_list" onclick="post('index.php',{});">
        一覧表示
    </div>
</nav>

<div id="main">
	<form action="index.php" method="post">
	ID：<input type="text" name="id" size="15" disabled="true" value=<?php echo $res['id']; ?>>
	最終更新日：<input type="text" name="updated" size="15" disabled="true"  value=<?php echo $res['updated']; ?>><br>

	姓：<input type="text" name="last_name" size="15"  value=<?php echo $res['last_name']; ?>>
	姓（かな）：<input type="text" name="last_name_kana" size="15"  value=<?php echo $res['last_name_kana']; ?>><br>

	名：<input type="text" name="first_name" size="15"  value=<?php echo $res['first_name']; ?>>
	名（かな）：<input type="text" name="first_name_kana" size="15"  value=<?php echo $res['first_name_kana']; ?>><br>

	郵便番号：<input type="text" name="post1" size="3"  value=<?php echo $res['post1']; ?>> - <input type="text" name="post2" size="4"  value=<?php echo $res['post2']; ?>><br>
	住所：<input type="text" name="address" size="40"  value=<?php echo $res['address']; ?>><br>

	<input type="submit" name="mode" value=<?php print($MODE[$mode]); ?>>
	</form>
<!-- #main --> </div>

<footer>
</footer>

<!-- #wrapper --> </div>
</body>
</html>