
<!-- カルテのヘッダー表示 -->
<div class="head-main"</div>
  <div class="head-left"> 登録日：<?php echo $user_list[0]['create_date']; ?> </div>
  <div class="head-center">お客様カルテ </div>
  <div class="head-right">No. <?php echo $user_list[0]['cust_id']; ?> </div>
</div>

<!-- 外枠のテーブル -->
<table class="table-tasukasu">
  <!-- 名前・住所・同意書の行（外枠） -->
  <tr >
    <td>
      <!-- 名前・住所・同意書のテーブル -->
      <table class="tbl-in-tasukasu">
        <tr>
          <th class="wid-80 font-16">ふりがな</th>
          <td class="wid-name font-16"> <div class="form-name"><?php echo $user_list[0]['name_f']; ?> 　<div>さま　</div></div></td>
          <th rowspan="3" class="wid-80">ご住所</th>
          <td rowspan="3" class="form-text-left"> <?php echo $user_list[0]['address']; ?> </th>
          <th rowspan="2" class="wid-80">同意書</th>
          <td rowspan="2"class="form-doui"> <?php echo $user_list[0]['doui']; ?> </th>
        </tr>
        <!-- ２行目に名前 -->
        <tr>
          <th class="wid-80">お名前</th>
          <td class=""> <div class="form-name"><?php echo $user_list[0]['name']; ?> <div> 様　</div></div></td>
        </tr>
      </table>
    </td>
  </tr>
  <!-- 連絡先の行（外枠） -->
  <tr>
    <td>
      <!-- 連絡先のテーブル -->
      <table class="tbl-in-tasukasu tbl-in-tel">
        <tr>
          <th class="wid-80">連絡先</th>
          <th class="wid-tel-sub">①</th>
          <td class="form-tel"> <div class="form-name"><?php echo $user_list[0]['tel_1']; ?> <div class="font-16"> <?php echo $user_list[0]['tel_1_m']; ?>　</div></div></td>
          <th class="wid-tel-sub">②</th>
          <td class="form-tel"> <div class="form-name"><?php echo $user_list[0]['tel_2']; ?> <div class="font-16"> <?php echo $user_list[0]['tel_2_m']; ?>　</div></div></td>
          <th class="wid-tel-sub">③</th>
          <td class="form-tel">  <div class="form-name"><?php echo $user_list[0]['tel_3']; ?> <div class="font-16"> <?php echo $user_list[0]['tel_3_m']; ?>　</div></div></td>
          <th class="wid-50">緊急</th>
          <td class="form-tel">  <div class="form-name"><?php echo $user_list[0]['tel_4']; ?> <div class="font-16"> <?php echo $user_list[0]['tel_4_m']; ?>　</div></div></td>
        </tr>
      </table>
    </td>
  </tr>
  <!-- 備考・暗号の行（外枠） -->
  <tr>
    <td>
      <!-- 備考・暗号のテーブル -->
      <table class="tbl-in-tasukasu tbl-in-comment">
        <tr>
          <th rowspan="3" class="wid-50" >備考</th>
          <td rowspan="3" class="form-comment"> <?php echo $user_list[0]['comment']; ?> </td>
          <td class="form-sec"> <?php echo $user_list[0]['sec_1']; ?> </td>
        </tr>
        <!-- 2行目に暗号② -->
        <tr>
          <td class="form-sec">  <?php echo $user_list[0]['sec_2']; ?> </td>
        </tr>
        <!-- 3行目に暗号③ -->
        <tr>
          <td class="form-sec">  <?php echo $user_list[0]['sec_3']; ?> </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
