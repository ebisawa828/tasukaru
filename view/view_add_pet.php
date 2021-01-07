<?php
  require_once '../class/add_pet.php';
  $list = new Add_Pet();
  $user_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>ペット追加</title>
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
  <br>

  <form action="view_add_pet.php" method="POST">
    <!-- お客様番号を送信 -->
    <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >

    <div class="form-sub">
      <p class="form-title-line">ペットの追加</p>
      <!-- ペットお名前(9文字以内) -->
      <div class="form-input">
        <div class="input-title">ペットお名前</div>
        <div class="input-text-pet"><input type="text" name="pet_name" autocomplete="off" required pattern='.{0,9}' title="9文字以内" value="<?php echo $_SESSION['post_data']['pet_name']; ?>"> </div>
      </div>
      <!-- 性別 -->
      <div class="form-input">
        <div class="input-title">性別</div>
        <!-- 性別の入力値を確認 -->
        <?php $checked_osu = ""; $checked_mesu = "";?>
        <?php if($_SESSION['post_data']['sex'] == "♂" ) { ?>
          <?php $checked_osu = 'checked="checked"'; ?>
        <?php } elseif($_SESSION['post_data']['sex'] == "♀" ) { ?>
          <?php $checked_mesu = 'checked="checked"'; ?>
        <?php } ?>
        <div class="input-sex"><input type="radio" name="sex" value="♂" <?php echo $checked_osu; ?> > オス</div>
        <div class="input-sex"><input type="radio" name="sex" value="♀" <?php echo $checked_mesu; ?> > メス</div>
      </div>
      <!-- 種類(9文字以内) -->
      <div class="form-input">
        <div class="input-title">種類</div>
        <div class="input-text-pet"><input type="text" name="type" autocomplete="off" pattern='.{0,9}' title="9文字以内" value="<?php echo $_SESSION['post_data']['type']; ?>"> </div>
      </div>
      <!-- 誕生月 -->
      <div class="form-input">
        <div class="input-title">誕生月</div>
        <select class="select-box" name="birth_Y">
          <?php if( ! empty($_SESSION['post_data']['birth_Y'])) { ?>
            <option value="<?php echo $_SESSION['post_data']['birth_Y']; ?>"> <?php echo $_SESSION['post_data']['birth_Y']; ?> </option>
            <option value="">-</option>
          <?php } else { ?>
            <option value="">-</option>
          <?php } ?>
          <!-- 現在から15年前までをリスト表示 -->
          <?php for($s=date('Y');$s>date('Y')-15;$s--) { ?>
            <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
          <?php } ?>
        </select>　年　

        <select class="select-box-month" name="birth_M">
          <?php if( ! empty($_SESSION['post_data']['birth_M'])) { ?>
            <option value="<?php echo $_SESSION['post_data']['birth_M']; ?>"> <?php echo $_SESSION['post_data']['birth_M']; ?> </option>
            <option value="">-</option>
          <?php } else { ?>
            <option value="">-</option>
          <?php } ?>
          <?php for($s=1;$s<=12;$s++) { ?>
            <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
          <?php } ?>
        </select>　月
      </div>
      <!-- 写真のURL -->
      <div class="form-input">
        <div class="input-title">写真のURL</div>
        <div class="input-text-gazo"><input type="text" name="gazo" autocomplete="off" style='ime-mode:disabled' value="<?php echo $_SESSION['post_data']['gazo']; ?>"> </div>
      </div>
      <!-- 性格・特徴(7行以内) -->
      <div class="form-input">
        <div class="input-title-2">性格・特徴</div>
      </div>
      <p class="input-textarea-comment"> <textarea name="chara" wrap="soft"><?php echo $_SESSION['post_data']['chara']; ?></textarea></p>
    </div>

    <!-- 登録・キャンセルボタン -->
    <div class="form-button">
      <div class="submit-base"><a href="view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
      <div class="submit-act"><input type="submit" value="追加する" ></div>
    </div>
  </form>

  <br>
  <!-- 既存のペット情報のフォーマット読み込み -->
  <?php include("../form/form_pet.php"); ?>
  <br>

</body>
</html>
