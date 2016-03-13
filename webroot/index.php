<?php
require_once('config.php');
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

    if($_POST['mode'] == M_INSERT){
        db_insert($pdo, $data);

    }else if($_POST['mode'] == M_UPDATE){
        db_update($pdo, $data);

    }else if($_POST['mode'] == M_DELETE){
        db_delete($pdo, $_POST['id']);

    }
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
<title>一覧｜名簿管理アプリ</title>
</head>
<body>
<div id="wrapper">

<header>
    <h1>一覧｜名簿管理アプリ</h1>

</header>

<nav>
    <form action="input.php" method="post">
    <?php printf('<input type="hidden" name="mode" value="%s">', M_INSERT); ?>
    <input type="submit" value="登録">
    </form>  
</nav>

<div id="main">
    <table>
    <tr>
    	<th>ID</th><th>氏名</th><th>ふりがな</th>
    	<th>郵便番号</th><th>住所</th><th>最終更新日</th>
        <!-- <th>更新</th><th>削除</th>-->
    </tr>
    <?php
    $sql = "SELECT * from list";
    $count = 0;
    foreach($pdo->query($sql) as $row){

        print('<tr onclick="edit();">');

        printf('<td>%s</td>', $row['id']);
        printf('<td>%s %s</td>', $row['last_name'], $row['first_name']);
        printf('<td>%s %s</td>', $row['last_name_kana'], $row['first_name_kana']);
        printf('<td>%s-%s</td>', $row['post1'], $row['post2']);
        printf('<td>%s</td>', $row['address']);

        $dt = strtotime($row['updated']);
        printf('<td>%s</td>', date('Y-m-d',$dt));

        print('</tr>');

        $count++;
    }
    ?>
    </table>
<!-- #main --> </div>

<footer>
</footer>

<div id="edit_box">
    <div id="btn_update" onclick="btn_update();">
        更新
    </div>
    <div id="btn_delete" onclick="btn_delete()";>
        削除
    </div>
    <div id="btn_cancel" onclick="btn_cancel();">
        キャンセル
    </div>
</div>
<div id ="edit_box_arrow"></div>

<!-- #wrapper --> </div>
</body>





</html>