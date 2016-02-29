<?php
require_once('db_func.php');
$link = db_connect();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>一覧｜名簿管理アプリ</title>
</head>
<body>
<h1>一覧｜名簿管理アプリ</h1>

<form action="data.php" method="post">
<input type="submit" name="mode" value="登録">
</form>
<?php $result = mysql_query('SELECT * from list'); ?>
<table>
<tr>
	<th>ID</th><th>姓</th><th>名</th><th>姓（かな）</th><th>名（かな）</th>
	<th>郵便番号</th><th>住所</th><th>最終更新日</th><th>更新</th><th>削除</th>
</tr>
<?php
while ($row = mysql_fetch_assoc($result)) {
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
    print('<form action="data.php" method="post">');
    printf('<input type="hidden" name="id" value="%s">', $row['id']);
	print('<input type="submit" name="mode" value="更新">');
	print('</td>');

	print('<td>');
    print('<input type="submit" name="mode" value="削除"></form>');
    print('</td>');
    print('</tr>');
}
?>
</table>
</body>
</html>

<?php db_close($link); ?>