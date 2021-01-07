<form action="view_del_come.php" method="POST">
  <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >
  <div class="form-sub-msg">
    <div class="form-msg"> 削除する利用履歴を選択してください </div>
    <!-- 削除・キャンセルボタン -->
    <div class="form-del-button">
      <div class="submit-base"><input type="submit" value="削除する" ></div>
      <div class="submit-base"><a href="./view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
    </div>
  </div>

  <p class="form-title" >ご利用履歴</p>
  <br>
  <table class="table-tasukasu table-come" >
    <!-- 見出し -->
    <tr>
      <th class="wid-50"> </th>
      <th class="wid-110">ご利用日</th>
      <th class="wid-77">コース</th>
      <th>内容</th>
      <th class="wid-100">金額</th>
      <th class="wid-65">担当</th>
      <th class="wid-80">時間</th>
    </tr>

    <!-- ラジオボタン設定 -->
    <div class="radio01">
      <!-- 最大7件まで表示 -->
      <?php foreach ($list->come_list as $key=>$val) { ?>
        <tr>
          <!-- ラジオボタンのカスタマイズ -->
          <?php $id_num = "radio01-" . $key;?>
          <td class="wid-50 <?php echo $class; ?>">
            <lavel>
              <input type="radio" name="come_id" value="<?php echo $list->come_list[$key]['come_id'];?>" class="radio01-input" id="<?php echo $id_num; ?>">
              <label for="<?php echo $id_num; ?>"></label>
            </lavel>
          </td>
          <td> <?php echo $list->come_list[$key]['str_date'];?> </td>
          <td> <?php echo $list->come_list[$key]['course']; ?> </td>
          <td class="form-comment"> <?php echo $list->come_list[$key]['content']; ?> </td>
          <td> <?php echo $list->come_list[$key]['price']; ?></td>
          <td> <?php echo $list->come_list[$key]['staff']; ?></td>
          <td> <?php echo $list->come_list[$key]['cut_time']; ?></td>
        </tr>
      <?php } ?>
    </div>
  </table>
</form>
