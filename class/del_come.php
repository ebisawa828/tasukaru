<?php
  require_once 'BaseClass.php';

  class Come_Del extends BaseClass
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

        //利用履歴情報取得
        $this->come_list = $this->Get_Come_list($cust_id);

        //利用履歴の有無確認
        if( empty($this->come_list[0]['come_id']) ) {
          $msg = $this->Out_Msg(14);
          header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");
          return;
        }
        //ご利用履歴の加工
        $this->Proc_Come(display);

        return $this->user_list;

      //POSTは確認画面の削除するボタンから
      } elseif(true == isset($_POST['cust_id'])) {
        $cust_id=$_POST['cust_id'];
        $come_id=$_POST['come_id'];

        //削除対象ペットを選択していない場合
        if(true != isset($_POST['come_id'])) {
          $msg = $this->Out_Msg(21);
          header("Location: ../view/view_del_come.php?id={$cust_id}&msg={$msg}");
          return;
        }

        //利用履歴削除
        $Result = $this->Del_Come($come_id);

        //もう一度削除画面にもどる
        header("Location: ../view/view_del_come.php?id={$cust_id}");
      }
    }
  }
?>
