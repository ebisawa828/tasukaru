<?php
  require_once 'BaseClass.php';

  class User_Mod extends BaseClass
  {
    public function main()
    {
      //GETは、メニューリストから修正を選択時
      if(true == isset($_GET['id'])){
        $cust_id=$_GET['id'];

        //エラー時以外は、$_SESSIONを削除
        if(false == isset($_GET['msg'])) {
          unset($_SESSION['post_data']);
        }

        //お客様リスト取得
        $this->user_list = $this->Get_User_list($cust_id);
        //お客様情報の加工
        $this->Proc_Cust(modify);

        return $this->user_list;

      //POSTは更新画面の修正するボタンから
      } elseif(true == isset($_POST['cust_id'])) {
        $cust_id=$_POST['cust_id'];
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $name_f = htmlspecialchars($_POST['name_f'], ENT_QUOTES);
        $address = htmlspecialchars($_POST['address'], ENT_QUOTES);
        $doui = $_POST['doui'];
        $tel_1 = htmlspecialchars($_POST['tel_1'], ENT_QUOTES);
        $tel_2 = htmlspecialchars($_POST['tel_2'], ENT_QUOTES);
        $tel_3 = htmlspecialchars($_POST['tel_3'], ENT_QUOTES);
        $tel_4 = htmlspecialchars($_POST['tel_4'], ENT_QUOTES);
        $tel_1_m = htmlspecialchars($_POST['tel_1_m'], ENT_QUOTES);
        $tel_2_m = htmlspecialchars($_POST['tel_2_m'], ENT_QUOTES);
        $tel_3_m = htmlspecialchars($_POST['tel_3_m'], ENT_QUOTES);
        $tel_4_m = htmlspecialchars($_POST['tel_4_m'], ENT_QUOTES);
        $comment= htmlspecialchars($_POST['comment'], ENT_QUOTES);
        $sec_1 = htmlspecialchars($_POST['sec_1'], ENT_QUOTES);
        $sec_2 = htmlspecialchars($_POST['sec_2'], ENT_QUOTES);
        $sec_3 = htmlspecialchars($_POST['sec_3'], ENT_QUOTES);

        //エラー時に入力情報を保持するため、POST変数を代入
        $_SESSION['post_data'] = $_POST;

        //住所欄の行数チェック(2行まで。改行は1個まで)
        $number = mb_substr_count(nl2br($address),'<br />');
        if($number > 1) {
          $msg = $this->Out_Msg(15);
          header("Location: ../view/view_mod_cust.php?id={$cust_id}&msg={$msg}");
          return;
        }
        //備考欄の行数チェック(７行まで。改行は６個まで)
        $number = mb_substr_count(nl2br($comment),'<br />');
        if($number > 6) {
          $msg = $this->Out_Msg(16);
          header("Location: ../view/view_mod_cust.php?id={$cust_id}&msg={$msg}");
          return;
        }
        //ユーザ情報変更
        $Result = $this->Mod_Cust($name,$name_f,$cust_id,$address,$doui,$tel_1,$tel_2,$tel_3,$tel_4,$tel_1_m,$tel_2_m,$tel_3_m,$tel_4_m,$comment,$sec_1,$sec_2,$sec_3);

        unset($_SESSION['post_data']);
        $msg = $this->Out_Msg(1,$name);
        header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");
      } else {
        $msg = "エラー";
        header("Location: ../view/error.php?msg={$msg}");
      }
   }


  }
 ?>
