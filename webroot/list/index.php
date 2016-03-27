<?php
ini_set( 'display_errors', 1 );
require_once('config.php');
require_once('db_func.php');
require_once('common_func.php');


/* Connect DB */
$pdo = db_connect();

/* Switch the mode */
if(isset($_POST['mode'])){
    $mode = $_POST['mode'];
    $data = $_POST;
    unset($data['mode']);
    unset($data['page']);

    if($mode == M_INSERT){
        db_insert($pdo, $data);
    }else if($mode == M_FILLFORM){
        $form_info = db_select($pdo, $data['id']);
    }else if($mode == M_UPDATE){
        db_update($pdo, $data);
    }else if($mode == M_DELETE){
        db_delete($pdo, $data['id']);
    }
}else {
    $mode = M_DISPLAY;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript">
    const M_DISPLAY = <?php print(M_DISPLAY); ?>;
    const M_INSERT  = <?php print(M_INSERT); ?>;
    const M_UPDATE  = <?php print(M_UPDATE); ?>;
    const M_DELETE  = <?php print(M_DELETE); ?>;
    const M_SEARCH  = <?php print(M_SEARCH); ?>;
    const M_FILLFORM= <?php print(M_FILLFORM); ?>;
</script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-2.2.2.min.js"></script>
<script type="text/javascript" src="js/jquery.autoKana.js"></script>
<script type="text/javascript" src="js/jquery.jpostal.js"></script>
<title>名簿管理アプリ</title>
</head>
<body onload="document.input_form.last_name.focus();">
<div id="wrapper">

<header>
    <h1>名簿管理アプリ</h1>
</header>

<nav>
    <div id="input_box">
        <form id="input_form" name="input_form" action="index.php" method="post">
            <table align="left">
            <tr>
            <td>
            <!-- ID */ -->
            <label>ID</label>
            </td>
            <td>
            <input id="i_id" type="text" name="id" readonly="true">
            </td>
            </tr>

            <tr>
            <td>
            <!-- ふりがな -->
            <label>ふりがな</label>
            </td>
            <td>
            <input id="i_last_name_kana" type="text" name="last_name_kana" pattern="^[ぁ-ん]+$" title="'ひらがな'で入力してください">
            <input id="i_first_name_kana" type="text" name="first_name_kana" pattern="^[ぁ-ん]+$" title="'ひらがな'で入力してください">
            </td>

            <td>
            <!-- 郵便番号 -->
            <label>〒</label>
            </td>
            <td>
            <input id="i_post1" type="text" name="post1" pattern="\d{3}" title="3桁の数字を入力してください" tabindex="3"> -
            <input id="i_post2" type="text" name="post2" pattern="\d{4}" title="4桁の数字を入力してください" tabindex="4">
            </td>
            <!-- 送信 -->
            <?php $s_value = $mode == M_FILLFORM ? $MODE[M_UPDATE] : "新規".$MODE[M_INSERT]; ?>
            <td>
            <input id="i_submit" type="submit" value="<?php print($s_value); ?>">
            </td>
            <tr>
            <td>
            <!-- 氏名 -->
            <label>氏名</label>
            </td>
            <td>
            <input id="i_last_name" type="text" name="last_name" pattern=".{1,}" title="'姓'を入力してください" tabindex="1">
            <input id="i_first_name" type="text" name="first_name" pattern=".{1,}" title="'名'を入力してください" tabindex="2">
            </td>

            <td>
            <!-- 住所 -->
            <label>住所</label>
            </td>
            <td colspan="2">
            <input id="i_address" type="text" name="address" pattern=".{1,}" title="住所を入力してください" tabindex="5">
            </td>

            <!-- mode -->
            <?php $m_value = $mode == M_FILLFORM ? M_UPDATE : M_INSERT ?>
            <input id="i_mode" type="hidden" name="mode" value="<?php print($m_value); ?>">

            <!-- page -->
            <input id="i_page" type="hidden" name="page" value="<?php print($_REQUEST["page"]); ?>">

            </tr>
            </table>
        </form>
        <form id="i_search_form" name="search_input_form" action="index.php" method="post">
        <table align="right">
        <tr>
        <td>
        <input id="i_seach_mode" type="hidden" name="mode" value="<?php print(M_SEARCH); ?>">
        <input id="i_search" name="search" type="text">
        </td>
        <td>
        <input id="i_search_btn" type="submit" value="検索">
        </td>
        </tr>
        <tr>
        <td align="right" colspan="2">表示件数
        <select name="n_disp">
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="60">60</option>
        <option value="100">100</option>
        <option value="200">200</option>
        </select>
        </td>
        </tr>
        </table>
        </form>
        <script type="text/javascript">
                /* ふりがなの自動補完 */
                $(function() {
                    $.fn.autoKana('#i_last_name', '#i_last_name_kana', {
                        katakana : false  //true：カタカナ、false：ひらがな（デフォルト）
                    });
                });
                $(function() {
                    $.fn.autoKana('#i_first_name', '#i_first_name_kana', {
                        katakana : false  //true：カタカナ、false：ひらがな（デフォルト）
                    });
                });

                /* 郵便番号 -> 住所の自動補完 */
                $('#postcode2').jpostal({
                        postcode : [
                                '#i_post1',
                                '#i_post2'
                        ],
                        address : {
                                '#i_address': '%3%4%5%6%7', 
                        }
                });
        </script>
        <?php 
            if($mode == M_FILLFORM){
                print('<script type="text/javascript">');
                printf('fill_form(%s)', json_safe_encode($form_info));
                print('</script>');
            }
        ?>
    </div>
</nav>

<div id="main">
    <table>
    <tr>
    	<th>ID</th><th>氏名</th><th>ふりがな</th>
    	<th>郵便番号</th><th>住所</th><th>最終更新日</th>
    </tr>
    <?php
    /* 表示対象のすべてのデータ取得 */
    $sql = "SELECT * from list";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $page = empty($_REQUEST["page"]) ? 1 : (int)$_REQUEST["page"];
    $max = $stmt->rowCount();
    if($mode == M_INSERT){
        $page = ceil($max/N_DISPLAY);
    }
    $start = $page == 1 ? 1 : ($page-1) * N_DISPLAY + 1;

    /* 個々のページ用のデータ取得 */
    $sql = "SELECT * from list LIMIT :start,:n_disp;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":start", $start, PDO::PARAM_INT);
    $stmt->bindValue(":n_disp", N_DISPLAY, PDO::PARAM_INT);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        printf('<tr onclick="edit(%s, %s, %s);">', $row['id'], "'".$row['last_name'].$row['first_name']."'", $page);

        printf('<td>%s</td>', $row['id']);
        printf('<td>%s %s</td>', $row['last_name'], $row['first_name']);
        printf('<td>%s %s</td>', $row['last_name_kana'], $row['first_name_kana']);
        printf('<td>%s-%s</td>', $row['post1'], $row['post2']);
        printf('<td>%s</td>', $row['address']);

        $dt = strtotime($row['updated']);
        printf('<td>%s</td>', date('Y-m-d',$dt));

        print('</tr>');

    }
    ?>
    </table>
    <div id="pager">
    <?php
    /* ページャー */
    $next = $page+1;
    $prev = $page-1;

    if($page != 1 ) {
        print('<a href="index.php?page=1">最初へ</a>');
        print("　|　");
        printf('<a href="index.php?page=%d">&laquo; 前へ</a>', $prev);
    }
    print("　");
    if($start+N_DISPLAY < $max){
        printf('<a href="index.php?page=%d">次へ &raquo;</a>', $next);
        print("　|　");
        printf('<a href="index.php?page=%d">最後へ</a>', ceil($max/N_DISPLAY));
    }

    print("<br>");
    printf("<small>%d/%d</small>", $page, ceil($max/N_DISPLAY));
    ?>
    <!-- #pager --></div>

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
