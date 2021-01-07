<?php
  require_once '../class/cust_list.php';
    $list = new User_List();
  $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>お客様別ご利用状況一覧</title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />

</head>

<body>
  <div class="manege-bgcolor">
  <br><br><br><br>
  <!--  対象が存在しない場合 -->
  <?php if( empty($list->user_list[0][0]['cust_id']) && empty($list->user_list[0]['cust_id']) ) { ?>
    <br><br><br><br><br><br>
    <p class="form-title"><?php echo $list->form_day; ?> のご利用はありません</p>
  <?php } else { ?>
    <!-- 日付が指定されている場合 -->
    <?php if(true == isset($list->t_day)) { ?>
      <p class="form-title"><?php echo $list->form_day; ?> のご利用一覧</p>
    <!-- 日付が指定されていない場合(全お客様一覧) -->
    <?php } else { ?>
      <p class="form-title">お客様の一覧</p>
    <?php } ?>
    <br>
    <?php include("../form/form_cust_list.php"); ?>
  <?php } ?>

  <br><br>
  <div class="submit form-text-center">
    <button type="button" onclick="history.back()">戻る</button>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  </div>
</body>
</html>
