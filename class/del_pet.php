<?php
  require_once 'BaseClass.php';

  class Pet_Del extends BaseClass
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

        //ペットの有無確認
        if( empty($this->pet_list[0]['pet_id']) ) {
          $msg = $this->Out_Msg(13);
          header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");
        }
        //ペット情報加工
        $this->Proc_Pet(display);

        return $this->user_list;

        //POSTは確認画面の削除するボタンから
      } elseif(true == isset($_POST['cust_id'])) {
        $pet_id=$_POST['pet_id'];
        $cust_id=$_POST['cust_id'];

        //削除対象ペットを選択していない場合
        if(true != isset($_POST['pet_id'])) {
          $msg = $this->Out_Msg(20);
          header("Location: ../view/view_del_pet.php?id={$cust_id}&msg={$msg}");
          return;
        }

        //ペットの名前取得
        $this->pet_list = $this->Get_Pet_name($pet_id);
        $pet_name=$this->pet_list[0]['pet_name'];

        //ペット情報削除
        $Result = $this->Del_Pet($pet_id);

        $msg = $this->Out_Msg(7,$pet_name);
        header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");

      }
    }
  }
?>
