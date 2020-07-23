<!-- 修正ボタンを押したが、誤入力等によりメッセージが表示され、修正した内容を表示するバージョン -->

<form action="view_mod_pet.php" method="POST">
  <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >

  <?php foreach ($_SESSION['post_data']['pet_id'] as $key=>$val) { ?>
    <table class="table-tasukasu">
      <!-- ペット番号を送信 -->
      <input type="hidden" name="pet_id[]" value="<?php echo $_SESSION['post_data']['pet_id'][$key]; ?>" >
      <!-- 1行目　名前・性別 -->
      <tr>
        <!-- ペットお名前(9文字以内) -->
        <th class="wid-150">ペットお名前</th>
        <td class="input-mod-text"> <input type="text" name="pet_name[]" autocomplete="off" pattern='.{0,9}' title="9文字以内" value="<?php echo $_SESSION['post_data']['pet_name'][$key];?>" > </td>
        <!-- 性別 -->
        <th class="wid-100">性別</th>
        <td class="input-sex">
          <?php $checked_osu[$key] = ""; $checked_mesu[$key] = "";?>
          <?php if($_SESSION['post_data']['sex'][$key] == "♂" ) { ?>
          <?php $checked_osu[$key] = 'checked="checked"'; ?>
          <?php } elseif($_SESSION['post_data']['sex'][$key] == "♀" ) { ?>
          <?php $checked_mesu[$key] = 'checked="checked"'; ?>
          <?php } ?>
          <input type="radio" name="sex[<?php echo $key; ?>]" value="♂" <?php echo $checked_osu[$key]; ?> > オス
          <input type="radio" name="sex[<?php echo $key; ?>]" value="♀" <?php echo $checked_mesu[$key]; ?> > メス
        </td>
      </tr>
      <!-- 2行目　種類・誕生月 -->
      <tr>
        <!-- 種類(9文字以内) -->
        <th>種類</th>
        <td class="input-mod-text"> <input type="text" name="type[]" autocomplete="off" pattern='.{0,9}' title="9文字以内" value="<?php echo $_SESSION['post_data']['type'][$key]; ?>" > </td>
        <!-- 誕生月 -->
        <th>誕生月</th>
        <td>
          <div class="form-input-birth">
            <select class="select-box" name="birth_Y[]">
              <?php if( ! empty($_SESSION['post_data']['birth_Y'][$key])) { ?>
                <option value="<?php echo $_SESSION['post_data']['birth_Y'][$key]; ?>"> <?php echo $_SESSION['post_data']['birth_Y'][$key]; ?> </option>
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
              <?php if( ! empty($_SESSION['post_data']['birth_M'][$key])) { ?>
                <option value="<?php echo $_SESSION['post_data']['birth_M'][$key]; ?>"> <?php echo $_SESSION['post_data']['birth_M'][$key]; ?> </option>
                <option value="">-</option>
              <?php } else { ?>
                <option value="">-</option>
              <?php } ?>

              <?php for($s=1;$s<=12;$s++) { ?>
                <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
              <?php } ?>
            </select>　月
          </div>
        </td>
      </tr>
      <!-- 写真のURL -->
      <tr>
        <th>写真のURL</th>
        <td colspan="3" class="input-mod-text"><input type="text" name="gazo[]" autocomplete="off" style='ime-mode:disabled' value="<?php echo $_SESSION['post_data']['gazo'][$key]; ?>"> </div>
      </tr>
      <!-- 性格・特徴(7行以内) -->
      <tr>
        <td colspan="4" class="mod-textarea-chara"> <textarea name="chara[]" wrap="soft" ><?php echo $_SESSION['post_data']['chara'][$key]; ?></textarea> </td>
      </tr>
    </table>
    <br>
  <?php } ?>

  <br>

  <!-- 修正・キャンセルボタン -->
  <div class="form-button">
    <div class="submit-base"><a href="./view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
    <div class="submit-act"><input type="submit" value="修正する" ></div>
  </div>
</form>
