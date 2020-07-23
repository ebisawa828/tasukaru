<!-- 現在の登録内容を表示するバージョン -->

<form action="view_mod_come.php" method="POST">
  <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >
  <!-- 外枠のテーブル -->
  <table class="table-tasukasu">
    <!-- 1行目 -->
    <tr>
      <th class="wid-160">ご利用日</th>
      <th class="wid-85">コース</th>
      <th>内容</th>
      <th class="wid-255"></th>
    </tr>
    <!-- 1行目 -->
    <?php foreach ($list->come_list as $key=>$val) { ?>
      <!-- 利用履歴番号を送信 -->
      <input type="hidden" name="come_id[]" value="<?php echo $list->come_list[$key]['come_id']; ?>" >
       <!-- ２行目 -->
      <tr>
        <!-- 利用開始、終了日 -->
        <td class="input-date-come">
          <input type="date" name="str_date[]" required value="<?php echo $list->come_list[$key]['str_date']; ?>">
          <br>～<br>
          <input type="date" name="end_date[]" required value="<?php echo $list->come_list[$key]['end_date']; ?>">
        </td>
        <!-- コース -->
        <td class="input-mod-text">
          <select class="select-box-course" name="course[]">
            <?php if( ! empty($list->come_list[$key]['course'])) { ?>
              <option value="<?php echo $list->come_list[$key]['course']; ?>"><?php echo $list->come_list[$key]['course']; ?></option>
            <?php } ?>
            <option value="">-</option>
            <option value="S">S</option>
            <option value="SC">SC</option>
            <option value="H">H</option>
            <option value="HSC">HSC</option>
            <option value="S部">S部</option>
            <option value="他">他</option>
          </select>
        </td>
        <!-- 内容(5行以内) -->
        <td class="mod-textarea-content">
          <textarea name="content[]" wrap="soft" cols="30" ><?php echo $list->come_list[$key]['content']; ?></textarea>
        </td>
        <!-- 金額・担当・時間の列 -->
        <td>
          <!-- 金額・担当・時間のテーブル -->
          <table class="tbl-in-tasukasu">
            <!-- １行目 金額(7文字以内) -->
            <tr>
              <th class="wid-65">金額</th>
              <td class="input-mod-text-com1">
                <input type="text" name="price[]" autocomplete="off" style='ime-mode:disabled' pattern='\d{0,7}' title="7文字以内" value="<?php echo $list->come_list[$key]['price']; ?>" >
              </td>
            </tr>
            <!-- 2行目 担当(3文字以内) -->
            <tr>
              <th>担当</th>
              <td class="input-mod-text-com1">
                <input type="text" name="staff[]" autocomplete="off" pattern='.{0,3}' title="3文字以内" value="<?php echo $list->come_list[$key]['staff']; ?>" >
              </td>
            </tr>
            <!-- 3行目 時間(8文字以内) -->
            <tr>
              <th >時間</th>
              <td class="input-mod-text-com2">
                <input type="text" name="cut_time[]" autocomplete="off" pattern='.{0,8}' title="8文字以内" value="<?php echo $list->come_list[$key]['cut_time']; ?>" >
              </td>
            </tr>
          </table>
        </td>
      </tr>
    <?php } ?>
  </table>

  <!-- 登録、キャンセルボタン -->
  <br>

  <div class="form-button">
    <div class="submit-base"><a href="./view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
    <div class="submit-act"><input type="submit" value="修正する" ></div>
  </div>
</form>
