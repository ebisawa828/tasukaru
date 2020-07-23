<?php
  require_once '../class/add_come.php';
  $list = new Come_Upload();
  $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>利用履歴の登録</title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />
</head>

<body>
  <!-- 登録時の事前チェックでエラー時に再入力を不要とするため、各SESSION変数を初期値として設定しておく -->

  <!-- メッセージがある場合は、表示 -->
  <?php if(true == isset($_GET['msg'])) { ?>
    <div class="form-sub-msg">
      <div class="form-msg"> <?php echo $_GET['msg']; ?> </div>
    </div>
  <?php } ?>
  <!-- お客様情報のフォーマット読み込み -->
  <?php include("../form/form_cust.php"); ?>
  <br><br>

  <form action="view_add_come.php" method="POST">
    <div class="form-sub">
      <p class="form-title-line">利用履歴登録</p>
      <!-- 利用開始日(初期値は現在日付) -->
      <div class="form-input">
        <div class="input-title">利用日</div>
        <?php if( ! empty($_SESSION['post_data']['str_date'])) { ?>
          <div><input type="date" name="str_date" required value="<?php echo $_SESSION['post_data']['str_date']; ?>"></div>
        <?php } else { ?>
          <!-- 現在日付を表示 -->
          <div><input type="date" name="str_date" required value="<?php echo date('Y-m-d'); ?>"></div>
        <?php } ?>
      </div>
      <!-- 終了日(初期値は現在日付) -->
      <div class="form-input">
        <div class="input-title">終了日</div>
        <?php if( ! empty($_SESSION['post_data']['end_date'])) { ?>
          <div><input type="date" name="end_date" autocomplete="off" required value="<?php echo $_SESSION['post_data']['end_date']; ?>"></div>
        <?php } else { ?>
          <!-- 現在日付を表示 -->
          <div><input type="date" name="end_date" autocomplete="off" required value="<?php echo date('Y-m-d'); ?>"></div>
        <?php } ?>
      </div>
      <!-- コース -->
      <div class="form-input">
        <div class="input-title">コース</div>
        <select class="select-box-course" name="course">
          <?php if( ! empty($_SESSION['post_data']['course'])) { ?>
            <option value="<?php echo $_SESSION['post_data']['course']; ?>"><?php echo $_SESSION['post_data']['course']; ?></option>
          <?php } ?>
          <option value="">-</option>
          <option value="S">S</option>
          <option value="SC">SC</option>
          <option value="H">H</option>
          <option value="HS">HS</option>
          <option value="HSC">HSC</option>
          <option value="S部">S部</option>
          <option value="他">他</option>
        </select>
      </div>
      <!-- 内容(5行以内) -->
      <div class="form-input">
        <div class="input-title">内容</div>
        <div class="input-textarea-content"><textarea name="content" wrap="soft" cols="30"><?php echo $_SESSION['post_data']['content']; ?></textarea></div>
      </div>
      <!-- 料金(7文字以内) -->
      <div class="form-input">
        <div class="input-title">料金</div>
        <div class="input-text-custid"><input type="text" name="price" autocomplete="off" style='ime-mode:disabled' pattern='\d{0,7}' title="7文字以内" value="<?php echo $_SESSION['post_data']['price']; ?>"></div>
      </div>
      <!-- 担当(3文字以内) -->
      <div class="form-input">
        <div class="input-title">担当</div>
        <div class="input-text-custid"><input type="text" name="staff" autocomplete="off" pattern='.{0,3}' title="3文字以内" value="<?php echo $_SESSION['post_data']['staff']; ?>"></div>
      </div>
      <!-- 時間(8文字以内) -->
      <div class="form-input">
        <div class="input-title">時間</div>
        <div class="input-text-cut-time"><input type="text" name="cut_time" autocomplete="off" pattern='.{0,8}' title="8文字以内" value="<?php echo $_SESSION['post_data']['cut_time']; ?>"></div>
      </div>
    </div>

    <!-- お客様番号を送信 -->
    <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >
    <!-- 登録・キャンセルボタン -->
    <div class="form-button">
      <div class="submit-base"><a href="view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
      <div class="submit-act"><input type="submit" value="登録する" ></div>
    </div>
  </form>

  <br><br><br>

  <!-- 利用履歴の有無を確認 -->
  <?php if( empty($list->come_list[0]['come_id']) ) { ?>
    <br><br>
    <p class="form-title">ご利用履歴はありません</p>
  <?php } else { ?>
    <?php include("../form/form_come.php"); ?>
  <?php } ?>

  <br><br>
</body>
</html>
