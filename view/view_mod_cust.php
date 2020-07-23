<?php
  require_once '../class/mod_cust.php';
  $list = new User_Mod();
  $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>お客様情報変更</title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />
</head>

<body>
  <!-- メッセージがある場合は、誤入力による再表示-->
  <?php if(true == isset($_GET['msg'])) { ?>
    <div class="form-sub-msg">
      <div class="form-msg"> <?php echo $_GET['msg']; ?> </div>
    </div>
    <!-- セッション変数から入力文字を取得して表示する-->
    <?php include("../form/form_mod_cust_rep.php"); ?>

  <!-- メッセージがない場合は、メニューリストからの呼び出し-->
  <?php } else { ?>
    <?php include("../form/form_mod_cust.php"); ?>
  <?php } ?>

</body>
</html>
