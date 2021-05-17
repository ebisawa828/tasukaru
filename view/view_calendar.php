<?php
  require_once '../class/calendar.php';
  $list = new User_List();
  $day_list = $list->main();
?>

<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>お客様利用件数カレンダー</title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />

</head>

<body>
  <div class="manege-bgcolor">
  <br><br>
  <p class="form-title" >ご利用カレンダー</p>
  <br>

  <TABLE class="table-tasukasu" cellpadding="4" cellspacing="1" style="background-color : #aaaaaa;text-align : center; font-size: 28px;">
    <!-- 表題 -->
    <CAPTION style="padding : 4px;font-size: 52px">
      <div class="submit form-text-center submit-cal head-cal">
        <A href="?m=<?php echo date('Ym', mktime(0, 0, 0, $list->month , 1, $list->year - 1)) ?>">&lt;&lt;前年</A>　
        <A href="?m=<?php echo date('Ym', mktime(0, 0, 0, $list->month - 1 , 1, $list->year)) ?>">&lt;前月</A>　
        <?php echo $list->year ?> 年 <?php echo $list->month ?> 月　
        <A href="?m=<?php echo date('Ym', mktime(0, 0, 0, $list->month + 1 , 1, $list->year)) ?>">翌月&gt;</A>　
        <A href="?m=<?php echo date('Ym', mktime(0, 0, 0, $list->month , 1, $list->year + 1)) ?>">翌年&gt;&gt;</A>
      </div>
    </CAPTION>
    <TBODY>
      <TR>
        <!-- 曜日の色を取得 -->
        <?php $i = 0;
          while ($i <= 6) {
          $c = $list->color_get($i);
        ?>
        <!-- 曜日名を出力 -->
        <TD style="color : <?php echo $c; ?> ;background-color : #999999;"> <?php echo $list->weekday[$i] ?> </TD>
          <?php $i++;
        } ?>
      </TR>
      <TR>
        <?php $i = 0;
        while ($i != date('w', mktime(0, 0, 0, $list->month, 1, $list->year))) { ?>
          <TD style="background-color : #FFEEFF;">　</TD>
          <?php $i++;
        }
        for ($days = 1; checkdate($list->month, $days, $list->year); $days++) {
          if ($i > 6) { ?>
            </TR><TR>
            <?php $i = 0;
          }
          $c = $list->color_get($i);
          //  1を01へ
          if ($days < 10)  {
            $day_tmp = "0" . $days;
          } else {
            $day_tmp =$days;
          }

          $tar_day = $list->year . "-" . $list->month . "-" . $day_tmp;

          if(  $list->n_flg != "1" ){
            if(  $days > $list->day || $list->n_flg == "2"){
              $tar_num = "";
            } elseif($day_list[$tar_day] != ""){
              $tar_num = $day_list[$tar_day] . "件";
            } else {
              $tar_num = "0件";
            }
          } elseif($day_list[$tar_day] != ""){
            $tar_num = $day_list[$tar_day] . "件";
          } else {
            $tar_num = "0件";
          }

          if ($days == $list->day && $list->n_flg == "") $bc = '#ffff00'; else $bc = '#FFEEFF'; ?>
          <TD height="70" style="color : <?php echo $c; ?> ;background-color : <?php echo $bc; ?>">
            <div style="font-size: 20px;text-align: left;vertical-align: top"><?php echo $days ?></div>
            <div style="color : #000080"><A href="view_cust_list.php?day=<?php echo date('Ymd', mktime(0, 0, 0, $list->month , $days, $list->year)) ?>"><?php echo $tar_num; ?></A></dvi>
          </TD>
          <?php $i++;
        }
        while ($i < 7) { ?>
          <TD style="background-color : #FFEEFF;">　</TD>
          <?php $i++;
        } ?>
      </TR>
    </TBODY>
  </TABLE>

  <br><br><br>
  <div class="submit form-text-center">
  <A href="../view_manage.php">裏メニューに戻る</A>
  </div>
  <br><br>
  </div>
</body>
</html>
