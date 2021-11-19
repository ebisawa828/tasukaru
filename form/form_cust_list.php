<table class="table-tasukasu table-cust-list" >
  <!-- 見出し -->
  <tr>
    <th class="wid-77">お客様番号</th>
    <th class="wid-110">お名前</th>
    <th class="wid-77">利用回数</th>
    <?php if(true == isset($list->t_day)) { ?>
      <th class="wid-100">前回利用日</th>
    <?php } else { ?>
      <th class="wid-100">最終利用日</th>
    <?php } ?>
  </tr>
  <!-- ユーザ一覧表示 -->
  <?php foreach ($user_list as $key=>$val) { ?>
    <tr>
      <td>
        <a href="../view/view_karte.php?id=<?php echo $user_list[$key]['cust_id']; ?>" target="_blank"><?php echo $user_list[$key]['cust_id'];?></a>
      </td>
      <td> <?php echo $user_list[$key]['name']; ?> </td>
      <td> <?php echo $user_list[$key]['num']; ?></td>
      <?php if( empty($user_list[$key]['last_date']) ) { ?>
        <td>初回</td>
      <?php } else { ?>
        <td><?php echo $user_list[$key]['last_date']; ?></td>
      <?php } ?>
    </tr>
  <?php } ?>
</table>
