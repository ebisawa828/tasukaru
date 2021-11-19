<!-- 現在の登録内容を表示するバージョン -->

<form action="view_mod_pet.php" method="POST">
  <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >

  <?php foreach ($list->pet_list as $key=>$val) { ?>
    <table class="table-tasukasu">
      <!-- ペット番号を送信 -->
      <input type="hidden" name="pet_id[]" value="<?php echo $list->pet_list[$key]['pet_id']; ?>" >
      <!-- 1行目　名前・性別 -->
      <tr>
        <!-- ペットお名前(9文字以内) -->
        <th class="wid-150">ペットお名前</th>
        <td class="input-mod-text"> <input type="text" name="pet_name[]" autocomplete="off" pattern='.{0,9}' title="9文字以内" value="<?php echo $list->pet_list[$key]['pet_name'];?>" > </td>
        <!-- 性別 -->
        <th class="wid-100">性別</th>
        <td class="input-sex">
          <input type="radio" name="sex[<?php echo $key; ?>]" value="♂" <?php echo $list->checked[$key]['checked_osu']; ?> > オス
          <input type="radio" name="sex[<?php echo $key; ?>]" value="♀" <?php echo $list->checked[$key]['checked_mesu']; ?>> メス
        </td>
      </tr>
      <!-- 2行目　種類・誕生月 -->
      <tr>
        <!-- 種類(9文字以内) -->
        <th>種類</th>
        <td class="input-mod-text"> <input type="text" name="type[]" autocomplete="off" pattern='.{0,9}' title="9文字以内" value="<?php echo $list->pet_list[$key]['type']; ?>" > </td>
        <!-- 誕生月 -->
        <th>誕生月</th>
        <td>
          <div class="form-input-birth">
            <select class="select-box" name="birth_Y[]">
              <?php if( ! empty($list->pet_list[$key]['birth_Y'])) { ?>
                <option value="<?php echo $list->pet_list[$key]['birth_Y']; ?>"> <?php echo $list->pet_list[$key]['birth_Y']; ?> </option>
                <option value="">-</option>
              <?php } else { ?>
                <option value="">-</option>
              <?php } ?>
              <!-- 現在から25年前までをリスト表示 -->
              <?php for($s=date('Y');$s>date('Y')-25;$s--) { ?>
                <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
              <?php } ?>
            </select>　年　

            <select class="select-box-month" name="birth_M[]">
              <?php if( ! empty($list->pet_list[$key]['birth_M'])) { ?>
                <option value="<?php echo $list->pet_list[$key]['birth_M']; ?>"> <?php echo $list->pet_list[$key]['birth_M']; ?> </option>
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
        <td colspan="3" class="input-mod-text"><input type="text" name="gazo[]" autocomplete="off" style='ime-mode:disabled' value="<?php echo $list->pet_list[$key]['gazo']; ?>"> </td>
      </tr>
      <!-- 性格・特徴(7行以内) -->
      <tr>
        <td colspan="4" class="mod-textarea-chara"> <textarea name="chara[]" wrap="soft" ><?php echo $list->pet_list[$key]['comment']; ?></textarea> </td>
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
