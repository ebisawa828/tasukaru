<p class="form-title" >ご利用履歴</p>
  <br>
  <table class="table-tasukasu table-come" >
    <!-- 見出し -->
    <tr>
      <th class="wid-110">ご利用日</th>
      <th class="wid-77">コース</th>
      <th>内容</th>
      <th class="wid-100">金額</th>
      <th class="wid-65">担当</th>
      <th class="wid-80">時間</th>
    </tr>
    <!-- 最大7件まで表示 -->
    <?php foreach ($list->come_list as $key=>$val) { ?>
      <tr>
        <td> <?php echo $list->come_list[$key]['str_date'];?> </td>
        <td> <?php echo $list->come_list[$key]['course']; ?> </td>
        <td class="form-comment"> <?php echo $list->come_list[$key]['content']; ?> </td>
        <td> <?php echo $list->come_list[$key]['price']; ?></td>
        <td> <?php echo $list->come_list[$key]['staff']; ?></td>
        <td> <?php echo $list->come_list[$key]['cut_time']; ?></td>
      </tr>
    <?php } ?>
</table>
