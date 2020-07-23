<!-- 修正ボタンを押したが、誤入力等によりメッセージが表示され、修正した内容を表示するバージョン -->

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
    <?php foreach ($_SESSION['post_data']['come_id'] as $key=>$val) { ?>
      <input type="hidden" name="come_id[]" value="<?php echo $_SESSION['post_data']['come_id'][$key]; ?>" >
      <!-- ２行目 -->
      <tr>
        <!-- 利用開始、終了日 -->
        <td class="input-date-come">
          <input type="date" name="str_date[]" required value="<?php echo $_SESSION['post_data']['str_date'][$key]; ?>">
          <br>～<br>
          <input type="date" name="end_date[]" required value="<?php echo $_SESSION['post_data']['end_date'][$key]; ?>">
        </td>
        <!-- コース -->
        <td class="input-mod-text">
          <select class="select-box-course" name="course[]">
            <?php if( ! empty($_SESSION['post_data']['course'][$key])) { ?>
              <option value="<?php echo $_SESSION['post_data']['course'][$key]; ?>"><?php echo $_SESSION['post_data']['course'][$key]; ?></option>
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
        <td class="mod-textarea-content" >
          <textarea name="content[]" wrap="soft" cols="30" ><?php echo $_SESSION['post_data']['content'][$key]; ?></textarea>
        </td>

        <!-- 金額・担当・時間の列 -->
        <td>
          <!-- 金額・担当・時間のテーブル -->
          <table class="tbl-in-tasukasu">
            <!-- １行目 金額(7文字以内) -->
            <tr>
              <th class="wid-65">金額</th>
              <td class="input-mod-text-com1">
                <input type="text" name="price[]" autocomplete="off" style='ime-mode:disabled' pattern='\d{0,7}' title="7文字以内" value="<?php echo $_SESSION['post_data']['price'][$key]; ?>" >
              </td>
            </tr>
            <!-- 2行目 担当(3文字以内) -->
            <tr>
              <th >担当</th>
              <td class="input-mod-text-com1">
                <input type="text" name="staff[]" autocomplete="off" pattern='.{0,3}' title="3文字以内" value="<?php echo $_SESSION['post_data']['staff'][$key]; ?>" >
              </td>
            </tr>
            <!-- 3行目 時間(8文字以内) -->
            <tr>
              <th >時間</th>
              <td class="input-mod-text-com2">
                <input type="text" name="cut_time[]" autocomplete="off" pattern='.{0,8}' title="8文字以内" value="<?php echo $_SESSION['post_data']['cut_time'][$key]; ?>" >
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
