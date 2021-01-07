<table class="table-tasukasu table-cust-list" >
  <!-- 見出し -->
  <tr>
    <th class="wid-77">お客様番号</th>
    <th class="wid-110">お名前</th>
    <th class="wid-77">利用回数</th>
    <th class="wid-100">最終利用日</th>
  </tr>
  <!-- ユーザ一覧表示 -->
  <?php foreach ($user_list as $key=>$val) { ?>
    <tr>
      <td>
        <a href="../view/view_karte.php?id=<?php echo $user_list[$key]['cust_id']; ?>" target="_blank"><?php echo $user_list[$key]['cust_id'];?></a>
      </td>
      <td> <?php echo $user_list[$key]['name']; ?> </td>
      <td> <?php echo $user_list[$key]['num']; ?></td>
      <td><?php echo $user_list[$key]['last_date']; ?></td>
    </tr>
  <?php } ?>
</table>
