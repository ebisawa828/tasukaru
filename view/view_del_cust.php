<?php
  require_once '../class/del_cust.php';
  $list = new User_Del();
  $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title><?php echo $user_list[0]['name']; ?> 削除</title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />
</head>

<body>
  <form action="view_del_cust.php" method="POST">
    <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >
    <div class="form-sub-msg">
      <div class="form-msg"> <?php echo $user_list[0]['name']; ?> 様を削除してもよろしいですか？ </div>
      <!-- 削除・キャンセルボタン -->
      <div class="form-del-button">
        <div class="submit-base"><input type="submit" value="削除する" ></div>
        <div class="submit-base"><a href="./view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
      </div>
    </div>
  </form>
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
</body>
</html>
