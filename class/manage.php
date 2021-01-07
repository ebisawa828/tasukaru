<?php
  require_once 'BaseClass.php';

  class User_List extends BaseClass
  {
    public function main()
    {
      //お客様登録件数取得
      $this->user_count = $this->Get_Cust_count();

      //ペット登録件数取得
      $this->pet_count = $this->Get_Pet_count();

      //利用履歴登録件数取得
      $this->come_count = $this->Get_Come_count();
    }
  }
?>
