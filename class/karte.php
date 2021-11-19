<?php
  require_once 'BaseClass.php';

  class User_List extends BaseClass
  {
    public function main()
    {
      //GETは、FullFreeから  顧客番号検索もGET(2021/11/13)
      if(true == isset($_GET['id'])){
        $cust_id=$_GET['id'];
      //POSTは検索画面から　電話番号検索
      } elseif(true == isset($_POST['tel'])) {
        $tel=$_POST['tel'];
        //電話番号から顧客番号を検索
        $this->user_id = $this->Get_User_id($tel);
        //1件のみ
        if( count($this->user_id) == 1) {
          $cust_id = $this->user_id[0]['cust_id'];
          //同一タブの抑止のため、GET形式で再度view_karteを呼び出す(2021/11/13)
          header("Location: ../view/view_karte.php?id={$cust_id}");
        //検索 0件
        } elseif( count($this->user_id) == 0) {
          //カルテがない
          $msg = $this->Out_Msg(10);
          header("Location: ../view/error.php?msg={$msg}");
        } else {
          $num = count($this->user_id);
          //対象の電話番号が複数
          $msg = $this->Out_Msg(20);
          header("Location: ../view/error.php?msg={$msg}");
        }
      //顧客番号検索  廃止(2021/11/13)
      } elseif(true == isset($_GET['cust_id'])) {
        $cust_id=$_GET['cust_id'];
      } else {
        $msg = "エラー";
        header("Location: ../view/error.php?msg={$msg}");
      }

      //お客様リスト取得
      $this->user_list = $this->Get_User_list($cust_id);
      //お客様の存在チェック
      if( count($this->user_list) == 0) {
        //カルテがない
        $msg = $this->Out_Msg(10);
        header("Location: ../view/error.php?msg={$msg}");
      //検索 0件
      }
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
    }
  }
?>
