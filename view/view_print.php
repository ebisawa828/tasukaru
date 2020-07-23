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

  <!--印刷用スタイル↓ -->
  <style>
  /* 改ページ */
  .pagebreak {
    break-after: page;
  }
  /* 余白 */
  @page {
    margin: 0;
  }
  </style>
</head>

<body>

  <br><br>
  <!-- お客様情報のフォーマット読み込み -->
  <?php include("../form/form_cust.php"); ?>
  <br>
  <!-- ペット情報のフォーマット読み込み -->
  <?php include("../form/form_pet.php"); ?>

  <!-- 改ページ -->
  <div class="pagebreak"></div>

  <br>
  <!-- 利用履歴は表示内容が印刷時に異なる -->
<p class="form-title" >ご利用履歴</p>

  <br>
  <table class="table-tasukasu table-come" >
        <!-- 見出し -->
    <tr>
      <th class="wid-110">ご利用日</th>
      <th class="wid-77">コース</th>
      <th>内容</th>
      <th class="wid-100">金額</th>
      <th class="wid-65">担当</th>
      <th class="wid-80">時間</th>
    </tr>

    <!-- 最初の一行は空行を挿入 -->
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>

    <?php foreach ($list->come_list as $key=>$val) { ?>
      <tr>
        <td> <?php echo $list->come_list[$key]['str_date'];?> </td>
        <td> <?php echo $list->come_list[$key]['course']; ?> </td>
        <td class="form-comment"> <?php echo $list->come_list[$key]['content']; ?> </td>
        <td>  <?php echo $list->come_list[$key]['price']; ?></td>
        <td>  <?php echo $list->come_list[$key]['staff']; ?></td>
        <td>  <?php echo $list->come_list[$key]['cut_time']; ?></td>
      </tr>
    <?php } ?>

  </table>


  <SCRIPT LANGUAGE="JavaScript">
    window.print();
    window.close();
  </SCRIPT>

</body>
</html>
