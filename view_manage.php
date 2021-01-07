<?php
   require_once 'class/manage.php';
   $list = new User_List();
   $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>助かる裏メニュー</title>
  <link rel="stylesheet" type="text/css" href="./css/tasukaru_style.css" media="all" />
</head>

<body>
  <div class="manege-bgcolor">
  <br><br>
  <!-- ロゴを左に挿入 -->
  <image src="./image/logo.png" width="20%">
  <!-- 助かる表示 -->
  <div class="form-tasukaru">助かる✋</div>
  <br>
  <div class="form-tasukaru" style="font-size: 36px;"> 【 裏メニュー 】 </div>
  <!-- バージョンファイル表示 -->
  <div class="form-ver"><?php include("./lst/version.list"); ?></div>
  <br><br>

  <div class="form-title"> 現在の登録数</div>
  <br>
  <table class="table-tasukasu" style="font-size: 42px; width: 400px;">
    <tr>
      <th>お客様</th>
      <td><?php echo $list->user_count; ?> 件</td>
    </tr>
    <tr>
      <th>ペット</th>
      <td><?php echo $list->pet_count; ?> 件</td>
    </tr>
    <tr>
      <th>利用履歴</th>
      <td><?php echo $list->come_count; ?> 件</td>
    </tr>
  </table>

  <br><br><br>
  <div class="submit form-text-center">
    <a href=view/view_calendar.php>ご利用カレンダー</a>
  </div>
  <br><br><br>
  <div class="submit form-text-center">
    <a href=view/view_cust_list.php>お客様の一覧</a>
  </div>

  <br><br>
  <div class="manege-bgcolor">
</body>
</html>
