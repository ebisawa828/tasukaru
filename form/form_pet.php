<!-- 最大４匹まで表示 -->
<?php foreach ($list->pet_list as $key=>$val) { ?>
  <table class="table-tasukasu table-pet">
    <tr>
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
