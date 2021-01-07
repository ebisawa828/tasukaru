<form action="view_del_pet.php" method="POST">
  <input type="hidden" name="cust_id" value="<?php echo $user_list[0]['cust_id']; ?>" >
  <div class="form-sub-msg">
    <div class="form-msg"> 削除するペットを選択してください </div>
    <!-- 削除・キャンセルボタン -->
    <div class="form-del-button">
      <div class="submit-base"><input type="submit" value="削除する" ></div>
      <div class="submit-base"><a href="./view_karte.php?id=<?php echo $user_list[0]['cust_id']; ?>">キャンセル</a></div>
    </div>
  </div>
    <!-- 最大４匹まで表示 -->

  <!-- ラジオボタン設定 -->
  <div class="radio01">
    <?php foreach ($list->pet_list as $key=>$val) { ?>
      <table class="table-tasukasu table-pet">
        <tr>

          <!-- ラジオボタンのカスタマイズ -->
          <?php $id_num = "radio01-" . $key;?>
          <td  rowspan="3" class="wid-50 <?php echo $class; ?>">
             <lavel>
                <input type="radio" name="pet_id" value="<?php echo $list->pet_list[$key]['pet_id'];?>" class="radio01-input" id="<?php echo $id_num; ?>">
                <label for="<?php echo $id_num; ?>"></label>
             </lavel>
          </td>

          <th class="wid-150">ペットお名前</th>
          <td > <?php echo $list->pet_list[$key]['pet_name'];?> </td>
          <th class="wid-80">性別</th>
          <td class="wid-50"> <?php echo $list->pet_list[$key]['sex']; ?> </td>
          <th class="wid-80">種類</th>
          <td> <?php echo $list->pet_list[$key]['type']; ?> </td>
          <th class="wid-80">年齢</th>
          <td class="wid-100">  <?php echo $list->pet_age[$key]['age']; ?></td>
        </tr>
        <tr>
          <td rowspan="2" colspan="7" class="form-chara"> <?php echo $list->pet_list[$key]['comment']; ?> </td>
          <th class="hei-40">写真</th>
        </tr>
        <tr>
          <td class="hei-80"><?php echo $list->dis[$key]; ?></td>
        </tr>

      </table>
    <?php } ?>
  </div>
</form>
