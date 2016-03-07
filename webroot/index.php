<?php
require_once('db_func.php');
$pdo = db_connect();

if(isset($_POST['mode'])){
    $data = array(
            "first_name" => $_POST['first_name'],
            "last_name" => $_POST['last_name'],
            "first_name_kana" => $_POST['first_name_kana'],
            "last_name_kana" => $_POST['last_name_kana'],
            "post1" => $_POST['post1'],
            "post2" => $_POST['post2'],
            "address" => $_POST['address'],
            );

    if($_POST['mode']=='登録'){
        db_insert($pdo, $data);

    }else if($_POST['mode']=='更新'){
        db_update($pdo, $data);

    }else if($_POST['mode']=='削除'){
        db_delete($pdo, $_POST['id']);
        
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>一覧｜名簿管理アプリ</title>
</head>
<body>
<h1>一覧｜名簿管理アプリ</h1>

<form action="input.php" method="post">
<input type="submit" name="mode" value="登録">
</form>
<table border="1">
<tr>
	<th>ID</th><th>姓</th><th>名</th><th>姓（かな）</th><th>名（かな）</th>
	<th>郵便番号</th><th>住所</th><th>最終更新日</th><th>更新</th><th>削除</th>
</tr>
<?php
$sql = "SELECT * from list";
foreach($pdo->query($sql) as $row){
	print('<tr>');
    printf('<td>%s</td>', $row['id']);
    printf('<td>%s</td>', $row['last_name']);
    printf('<td>%s</td>', $row['first_name']);
    printf('<td>%s</td>', $row['last_name_kana']);
    printf('<td>%s</td>', $row['first_name_kana']);
    printf('<td>%s-%s</td>', $row['post1'], $row['post2']);
    printf('<td>%s</td>', $row['address']);

    $dt = strtotime($row['updated']);
    printf('<td>%s</td>', date('Y-m-d',$dt));

    print('<td>');
    print('<form action="input.php" method="post">');
    printf('<input type="hidden" name="id" value="%s">', $row['id']);
	print('<input type="submit" name="mode" value="更新">');
    print('</form>');
	print('</td>');

	print('<td>');
    print('<form action="index.php" method="post">');
    printf('<input type="hidden" name="id" value="%s">', $row['id']);
    print('<input type="submit" name="mode" value="削除"></form>');
    print('</form>');
    print('</td>');
    print('</tr>');
}
?>
</table>
</body>
</html>