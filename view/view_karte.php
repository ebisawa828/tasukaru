<?php
  require_once '../class/karte.php';
  $list = new User_List();
  $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title><?php echo $user_list[0]['name']; ?></title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />
</head>

<body>
  <!-- ヘッダーメニュー -->
  <p><div id="user-menu">
    <ul id="dropmenu">
      <li><a>お客様</a>
        <ul>
          <li><a href="view_create_cust.php">登録</a></li>
          <li><a href="view_mod_cust.php?id=<?php echo $user_list[0]['cust_id']; ?>">修正</a></li>
        </ul>
      </li>
      <li><a>ペット</a>
        <ul>
          <li><a href="view_add_pet.php?id=<?php echo $user_list[0]['cust_id']; ?>">追加</a></li>
          <li><a href="view_mod_pet.php?id=<?php echo $user_list[0]['cust_id']; ?>">修正</a></li>
        </ul>
      </li>
      <li><a>利用履歴</a>
        <ul>
          <li><a href="view_add_come.php?id=<?php echo $user_list[0]['cust_id']; ?>">追加</a></li>
          <li><a href="view_mod_come.php?id=<?php echo $user_list[0]['cust_id']; ?>">修正</a></li>
        </ul>
      </li>
      <li><a href="view_print.php?id=<?php echo $user_list[0]['cust_id']; ?>&print=1" target="_blank">印刷</a></li>
    </ul>
  </div>
  </p>
  <br>

  <!-- メッセージ有無にて表示形式を設定 -->
  <?php if(true == isset($_GET['msg'])) { ?>
    <div class="form-sub-msg">
      <div class="form-msg"> <?php echo $_GET['msg']; ?> </div>
    </div>
  <?php } else { ?>
    <!-- メッセージがない場合は、空白行を挿入 -->
    <div class="sub-msg-dum"> </div>
  <?php } ?>

  <!-- お客様情報のフォーマット読み込み -->
  <?php include("../form/form_cust.php"); ?>
  <br>
  <!-- ペット情報のフォーマット読み込み -->
  <?php include("../form/form_pet.php"); ?>
  <br>
  <!-- 利用履歴の有無による設定 -->
  <?php if( empty($list->come_list[0]['come_id']) ) { ?>
    <br><br>
    <p class="form-title">ご利用履歴はありません</p>
  <?php } else { ?>
    <!-- 利用履歴情報のフォーマット読み込み -->
    <?php include("../form/form_come.php"); ?>
  <?php } ?>

  <br><br>
  <!-- 自動クローズ設定（60分） -->
  <SCRIPT LANGUAGE="JavaScript">
    setTimeout("window.close()", 3600000);
  </SCRIPT>
</body>
</html>
