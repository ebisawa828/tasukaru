<?php
  require_once '../class/create_cust.php';
  $cust = new Create_Cust();
  $create_cust = $cust->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>お客様登録</title>
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

  <form action="" method="POST">
    <!-- 入力フォームの囲み線 -->
    <div class="form-sub">
      <p class="form-title-line">お客様の登録</p>
      <!-- カルテ登録日(初期値は現在日付) -->
      <div class="form-input">
        <div class="input-title">カルテ登録日</div>
        <?php if(! empty($_SESSION['post_data']['create_date'])) { ?>
          <input type="date" name="create_date" required value="<?php echo $_SESSION['post_data']['create_date']; ?>">
        <?php } else { ?>
          <!-- 現在日付を表示 -->
          <input type="date" name="create_date" required value="<?php echo date('Y-m-d'); ?>">
        <?php } ?>
      </div>
      <!-- お客様コード(数字5文字) -->
      <div class="form-input">
        <div class="input-title">お客様コード(必須)</div>
        <div class="input-text-custid"><input type="text" name="cust_id" autocomplete="off" style='ime-mode:disabled' required pattern='\d{5}' title="数字５桁" value="<?php echo $_SESSION['post_data']['cust_id']; ?>"> (数字５桁)</div>
      </div>
      <!-- ふりがな(13文字以内) -->
      <div class="form-input">
        <div class="input-title">ふりがな</div>
        <div class="input-text-name"><input type="text" name="name_f" autocomplete="off" pattern='.{0,13}' title="13文字以内" value="<?php echo $_SESSION['post_data']['name_f']; ?>"> </div>
      </div>
      <!-- お名前(13文字以内) -->
      <div class="form-input">
        <div class="input-title">お名前(必須)</div>
        <div class="input-text-name"><input type="text" name="name" autocomplete="off" required pattern='.{0,13}' title="13文字以内" value="<?php echo $_SESSION['post_data']['name']; ?>"></div>
      </div>
      <!-- ご住所(46文字以内、2行以内) -->
      <div class="form-input">
        <div class="input-title">ご住所(必須)</div>
        <div class="input-textarea-address"> <textarea name="address" wrap="soft" required maxlength="46" rows="2" title="46文字以内"><?php echo $_SESSION['post_data']['address']; ?></textarea></div>
      </div>
      <!-- 同意書の有無 -->
      <div class="form-input">
        <div class="input-title">同意書</div>
        <?php if( ! empty($_SESSION['post_data']['doui'])) { ?>
          <div class="input-ckbox"> <input type="checkbox" name="doui" value="●" checked="checked"> </div>
        <?php } else { ?>
          <div class="input-ckbox"> <input type="checkbox" name="doui" value="●" > </div>
        <?php } ?>
        </td>
      </div>
      <!-- 連絡先(10-11文字)と補足(2文字以内) -->
      <div class="form-input">
        <div class="input-title">連絡先①</div>
        <div class="input-text-tel"><input type="text" name="tel_1" autocomplete="off" style='ime-mode:disabled' pattern='\d{10,11}' title="数字10～11桁" value="<?php echo $_SESSION['post_data']['tel_1']; ?>"> </div>
        <div class="input-text-tel-sub"><input type="text" name="tel_1_m" autocomplete="off" pattern='.{0,2}' title="2文字以内" value="<?php echo $_SESSION['post_data']['tel_1_m']; ?>"> </div>
      </div>
      <div class="form-input">
        <div class="input-title">連絡先②</div>
        <div class="input-text-tel"><input type="text" name="tel_2" autocomplete="off" style='ime-mode:disabled' pattern='\d{10,11}' title="数字10～11桁" value="<?php echo $_SESSION['post_data']['tel_2']; ?>"> </div>
        <div class="input-text-tel-sub"><input type="text" name="tel_2_m" autocomplete="off" pattern='.{0,2}' title="2文字以内" value="<?php echo $_SESSION['post_data']['tel_2_m']; ?>"> </div>
      </div>
      <div class="form-input">
        <div class="input-title">連絡先③</div>
        <div class="input-text-tel"><input type="text" name="tel_3" autocomplete="off" style='ime-mode:disabled' pattern='\d{10,11}' title="数字10～11桁" value="<?php echo $_SESSION['post_data']['tel_3']; ?>"> </div>
        <div class="input-text-tel-sub"><input type="text" name="tel_3_m" autocomplete="off" pattern='.{0,2}' title="2文字以内" value="<?php echo $_SESSION['post_data']['tel_3_m']; ?>"> </div>
      </div>
      <div class="form-input">
        <div class="input-title">緊急連絡先</div>
        <div class="input-text-tel"><input type="text" name="tel_4" autocomplete="off" style='ime-mode:disabled' pattern='\d{10,11}' title="数字10～11桁" value="<?php echo $_SESSION['post_data']['tel_4']; ?>"> </div>
        <div class="input-text-tel-sub"><input type="text" name="tel_4_m" autocomplete="off" pattern='.{0,2}' title="2文字以内" value="<?php echo $_SESSION['post_data']['tel_4_m']; ?>"> </div>
      </div>
      <!-- 備考(7行以内) -->
      <div class="form-input">
        <div class="input-title-2">備考</div>
      </div>
      <p class="input-textarea-comment align-r"> <textarea name="comment" wrap="soft"><?php echo $_SESSION['post_data']['comment']; ?></textarea></p>
      <!-- 暗号３つ -->
      <div class="form-input">
        <div class="input-title">暗号①</div>
        <select class="select-box" name="sec_1">
          <?php if( ! empty($_SESSION['post_data']['sec_1'])) { ?>
            <option value="<?php echo $_SESSION['post_data']['sec_1']; ?>"><?php echo $_SESSION['post_data']['sec_1']; ?></option>
          <?php } ?>
          <option value="">-</option>
          <option value="D">D</option>
          <option value="DD">DD</option>
          <option value="K">K</option>
          <option value="KK">KK</option>
          <option value="R">R</option>
        </select>
      </div>
      <div class="form-input">
        <div class="input-title">暗号②</div>
        <select class="select-box" name="sec_2">
          <?php if( ! empty($_SESSION['post_data']['sec_2'])) { ?>
            <option value="<?php echo $_SESSION['post_data']['sec_2']; ?>"><?php echo $_SESSION['post_data']['sec_2']; ?></option>
          <?php } ?>
          <option value="">-</option>
          <option value="D">D</option>
          <option value="DD">DD</option>
          <option value="K">K</option>
          <option value="KK">KK</option>
          <option value="R">R</option>
        </select>
      </div>
      <div class="form-input">
        <div class="input-title">暗号③</div>
        <select class="select-box" name="sec_3" >
          <?php if( ! empty($_SESSION['post_data']['sec_3'])) { ?>
            <option value="<?php echo $_SESSION['post_data']['sec_3']; ?>"><?php echo $_SESSION['post_data']['sec_3']; ?></option>
          <?php } ?>
          <option value="">-</option>
          <option value="D">D</option>
          <option value="DD">DD</option>
          <option value="K">K</option>
          <option value="KK">KK</option>
          <option value="R">R</option>
        </select>
      </div>
    </div>

    <br>
    <!-- ペットの登録 -->
    <div class="form-sub">
      <p class="form-title-line">ペットの登録</p>
      <!-- 最大４匹 -->
      <?php for($i=0;$i<=3;$i++) { ?>
        <div class="form-sub">
          <!-- ペットお名前(9文字以内) -->
          <div class="form-input">
            <div class="input-title">ペットお名前 <?php echo $i+1 ; ?> </div>
            <div class="input-text-pet"><input type="text" name="pet_name[]" autocomplete="off" pattern='.{0,9}' title="9文字以内" value="<?php echo $_SESSION['post_data']['pet_name'][$i]; ?>"> </div>
          </div>
          <!-- 性別 -->
          <div class="form-input">
            <div class="input-title">性別</div>
            <!-- セッション変数を確認して、初期値を設定 -->
            <?php $checked_osu[$i] = ""; $checked_mesu[$i] = "";?>
            <?php if($_SESSION['post_data']['sex'][$i] == "♂" ) { ?>
              <?php $checked_osu[$i] = 'checked="checked"'; ?>
            <?php } elseif($_SESSION['post_data']['sex'][$i] == "♀" ) { ?>
              <?php $checked_mesu[$i] = 'checked="checked"'; ?>
            <?php } ?>
            <div class="input-sex"><input type="radio" name="sex[<?php echo $i; ?>]" value="♂" <?php echo $checked_osu[$i]; ?> > オス</div>
            <div class="input-sex"><input type="radio" name="sex[<?php echo $i; ?>]" value="♀" <?php echo $checked_mesu[$i]; ?> > メス</div>
          </div>
          <!-- 種類(9文字以内) -->
          <div class="form-input">
            <div class="input-title">種類</div>
            <div class="input-text-pet"><input type="text" name="type[]" autocomplete="off" pattern='.{0,9}' title="9文字以内" value="<?php echo $_SESSION['post_data']['type'][$i]; ?>"> </div>
          </div>
          <!-- 誕生月 -->
          <div class="form-input">
            <div class="input-title">誕生月</div>
            <select class="select-box" name="birth_Y[]">
              <?php if( ! empty($_SESSION['post_data']['birth_Y'][$i])) { ?>
                <option value="<?php echo $_SESSION['post_data']['birth_Y'][$i]; ?>"> <?php echo $_SESSION['post_data']['birth_Y'][$i]; ?> </option>
                <option value="">-</option>
              <?php } else { ?>
                <option value="">-</option>
              <?php } ?>
              <!-- 現在から15年前までをリスト表示 -->
              <?php for($s=date('Y');$s>date('Y')-15;$s--) { ?>
                <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
              <?php } ?>
            </select>　年
            　
            <select class="select-box-month" name="birth_M[]">
              <?php if( ! empty($_SESSION['post_data']['birth_M'][$i])) { ?>
                <option value="<?php echo $_SESSION['post_data']['birth_M'][$i]; ?>"> <?php echo $_SESSION['post_data']['birth_M'][$i]; ?> </option>
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
            <div class="input-text-gazo"><input type="text" name="gazo[]" autocomplete="off" style='ime-mode:disabled' value="<?php echo $_SESSION['post_data']['gazo'][$i]; ?>"> </div>
          </div>
          <!-- 性格・特徴(7行以内) -->
          <div class="form-input">
            <div class="input-title-2">性格・特徴</div>
          </div>
          <div class="input-textarea-comment align-r"> <textarea name="chara[]" wrap="soft"><?php echo $_SESSION['post_data']['chara'][$i]; ?></textarea></div>

        </div>
      <?php } ?>
    </div>

    <!-- 登録・キャンセルボタン -->
    <div class="form-button">
      <div class="submit-base"><input type="button" onclick="window.close();" value="キャンセル" ></div>
      <div class="submit-act"><input type="submit" value="登録する" ></div>
    </div>
  </form>

</body>
</html>
