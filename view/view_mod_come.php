<?php
  require_once '../class/mod_come.php';
  $list = new Com_Mod();
  $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>利用履歴の修正</title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />
</head>

<body>
  <!-- メッセージがある場合は、表示 -->
  <?php if(true == isset($_GET['msg'])) { ?>
    <div class="form-sub-msg">
      <div class="form-msg"> <?php echo $_GET['msg']; ?> </div>
    </div>
  <?php } ?>

  <br><br>
  <!-- お客様情報のフォーマット読み込み -->
  <?php include("../form/form_cust.php"); ?>
  <br><br>

  <p class="form-title">利用履歴の修正</p>
  <br>
  <!-- メッセージの有無による設定 -->
  <!-- GETの場合は、誤入力による再表示-->
  <?php if(true == isset($_GET['msg'])) { ?>
    <?php include("../form/form_mod_come_rep.php"); ?>

  <!-- POSTの場合は、メニューリストからの呼び出し-->
  <?php } else { ?>
    <?php include("../form/form_mod_come.php"); ?>
  <?php } ?>

  <br><br>

</body>
</html>
