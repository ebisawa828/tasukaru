<?php
  require_once 'BaseClass.php';

  class User_Del extends BaseClass
  {
    public function main()
    {
      //GETは、メニューリストから削除を選択時
      if(true == isset($_GET['id'])){
        $cust_id=$_GET['id'];

        //お客様リスト取得
        $this->user_list = $this->Get_User_list($cust_id);

        //お客様情報の加工
        $this->Proc_Cust(display);

        //ペット情報取得
        $this->pet_list = $this->Get_Pet_list($cust_id);
        //ペット情報加工
        $this->Proc_Pet(display);

        //利用履歴情報取得
        $this->come_list = $this->Get_Come_list($cust_id);
        //ご利用履歴の加工
        $this->Proc_Come(display);

        return $this->user_list;

      //POSTは確認画面の削除するボタンから
      } elseif(true == isset($_POST['cust_id'])) {
        $cust_id=$_POST['cust_id'];

        //お客様リスト取得
        $this->user_list = $this->Get_User_list($cust_id);
        $name=$this->user_list[0]['name'];
        //ユーザ情報削除
        $Result = $this->Del_Cust($cust_id);

        $msg = $this->Out_Msg(6,$name);
        header("Location: ../view/error.php?msg={$msg}");
      }
    }
  }
 ?>
