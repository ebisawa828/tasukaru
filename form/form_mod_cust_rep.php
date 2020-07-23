<!-- 修正ボタンを押したが、誤入力等によりメッセージが表示され、修正した内容を表示するバージョン -->

<form action="view_mod_cust.php" method="POST">
  <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >

  <div class="form-sub">

    <p class="form-title-line">お客様情報の修正</p>
    <!-- カルテ登録日 -->
    <div class="form-input">
      <div class="input-title">カルテ登録日</div>
      <div class="font-32"><?php echo $user_list[0]['create_date']; ?></div>
    </div>
    <!-- お客様コード(数字5文字) -->
    <div class="form-input">
      <div class="input-title">お客様コード</div>
      <div class="input-text-custid"><?php echo $user_list[0]['cust_id']; ?></div>
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
      <div class="input-textarea-address"> <textarea name="address" wrap="soft" required pattern='.{0,46}' title="46文字以内" ><?php echo $_SESSION['post_data']['address']; ?></textarea></div>
    </div>
    <!-- 同意書の有無 -->
    <div class="form-input">
      <div class="input-title">同意書</div>
      <?php if( ! empty($_SESSION['post_data']['doui'])) { ?>
        <div class="input-ckbox"> <input type="checkbox" name="doui" value="●" checked="checked"> </div>
      <?php } else { ?>
        <div class="input-ckbox"> <input type="checkbox" name="doui" value="●" > </div>
      <?php } ?>
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
      <div class="input-title">備考</div>
    </div>
    <div class="input-textarea-comment align-r"> <textarea name="comment" wrap="soft"><?php echo $_SESSION['post_data']['comment']; ?></textarea></div>
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
      <select class="select-box" name="sec_3">
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

  <!-- 登録・キャンセルボタン -->
  <div class="form-button">
    <div class="submit-base"><a href="./view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
    <div class="submit-act"><input type="submit" value="修正する" ></div>
  </div>
</form>
