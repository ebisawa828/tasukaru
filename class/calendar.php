<?php
  require_once 'BaseClass.php';

  class User_List extends BaseClass
  {
    public function main()
    {

      $m = $_GET['m'];
      $this->year = date('Y');
      $this->month = date('n');
      $now_ym = $this->year . $this->month;
      //現在の年月以外の場合
      if ($m != "" && $m != $now_ym ) {
          $this->year = date('Y', strtotime($m . '01'));
          $this->month = date('n', strtotime($m . '01'));
          if ($m > $now_ym) {
            $this->n_flg = "2";
          } else {
            $this->n_flg = "1";
          }
      }
      $this->day = date('j');

      $this->weekday = array('日', '月', '火', '水', '木', '金', '土');
      //お客様別利用履歴一覧取得
      $this->user_list = $this->Get_dayly_come_list();

      foreach ($this->user_list as $key=>$val) {
        foreach ($this->user_list[$key] as $key2 => $val2) {
          if($key2 == 'str_date') {
            $str_day = $val2;
          } else{
            $this->day_list[$str_day] = $val2;
          }
        }
      }

      return $this->day_list;
    }

  }
?>
