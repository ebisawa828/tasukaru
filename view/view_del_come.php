<?php
  require_once '../class/del_come.php';
  $list = new Come_del();
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

  <!-- 利用履歴削除のフォーマット読み込み -->
  <?php include("../form/form_del_come.php"); ?>

  <br><br>
</body>
</html>
