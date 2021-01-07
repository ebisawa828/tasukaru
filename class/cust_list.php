<?php
  require_once 'BaseClass.php';

  class User_List extends BaseClass
  {
    public function main()
    {
      if(true == isset($_GET['day'])){
        $this->t_day = $_GET['day'];
        $this->user_list_tmp = $this->Get_Cust_dayly_list($this->t_day);
        //指定日付のお客様一覧取得
        foreach ($this->user_list_tmp as $key=>$val) {
          foreach ($this->user_list_tmp[$key] as $key2 => $val2) {
            $this->user_list_tmp2[$key] = $this->Get_Cust_come_dayly_list($val2);
            //$this->user_list[$key] = $this->Get_Cust_come_dayly_list($val2);
          }
        }
        //3次元配列 → ２次元配列へ整理(全お客様と配列の構造を合わせる)
        foreach ($this->user_list_tmp2 as $key=>$val) {
          foreach ($this->user_list_tmp2[$key] as $key2 => $val2) {
            $this->user_list[$key] = $val2;
          }
        }

        $this->form_day = substr($this->t_day,0,4) . "年". substr($this->t_day,4,2) . "月" . substr($this->t_day,-2) . "日";
      } else {
        //お客様別利用履歴一覧取得
        $this->user_list = $this->Get_Cust_come_all_list();
      }
      return $this->user_list;
    }
  }
?>
