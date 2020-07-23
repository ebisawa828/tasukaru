<?php
  require_once 'BaseClass.php';

  class Add_Pet extends BaseClass
  {
    public function main()
    {
      //GETは、メニューリストから選択時
      if(true == isset($_GET['id'])) {
        $cust_id=$_GET['id'];

        //エラー時以外は、$_SESSIONを削除
        if(false == isset($_GET['msg'])) {
          unset($_SESSION['post_data']);
        }
        //リスト取得
        $this->user_list = $this->Get_User_list($cust_id);
        //お客様情報の加工
        $this->Proc_Cust(display);

        //ペット情報取得
        $this->pet_list = $this->Get_Pet_list($cust_id);

        //ペット情報が既に４匹いる場合
        if(count($this->pet_list) >= 4 ) {
          $msg = $this->Out_Msg(12);
          header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");
          return;
        }
        //ペット情報加工
        $this->Proc_Pet(display);

        return $this->user_list;

      //POSTは修正完了時
      } elseif(true == isset($_POST['cust_id'])) {
        $cust_id=$_POST['cust_id'];
        $pet_name = htmlspecialchars($_POST['pet_name'], ENT_QUOTES);
        $sex = htmlspecialchars($_POST['sex'], ENT_QUOTES);
        $type = htmlspecialchars($_POST['type'], ENT_QUOTES);
        //ペットの誕生日の日付は１日に固定
        $birthday = $_POST['birth_Y'] . "-" . $_POST['birth_M'] . "-01";
        $chara = htmlspecialchars($_POST['chara'], ENT_QUOTES);
        $gazo = $_POST['gazo'];

        //エラー時に入力情報を保持するため、POST変数を代入
        $_SESSION['post_data'] = $_POST;

        //ペットの性格・特徴の行数チェック(７行まで。改行は６個まで)
        $chara = $_POST['chara'];
        $number = mb_substr_count(nl2br($chara),'<br />');
        if($number > 6) {
          $msg = $this->Out_Msg(17);
          header("Location: ../view/view_add_pet.php?id={$cust_id}&msg={$msg}");
          return;
        }

        //ペットの誕生月確認(年、月のどちらかが未入力の場合)
        if( empty($_POST['birth_Y']) and (! empty($_POST['birth_M'])) ) {
          $msg = $this->Out_Msg(19,$pet_name);
          header("Location: ../view/view_add_pet.php?id={$cust_id}&msg={$msg}");
          return;
        } elseif ( ! empty($_POST['birth_Y']) and ( empty($_POST['birth_M'])) ) {
          $msg = $this->Out_Msg(19,$pet_name);
          header("Location: ../view/view_add_pet.php?id={$cust_id}&msg={$msg}");
          return;
        }

        //ペット情報追加
        $Result = $this->Add_Pet($pet_name,$cust_id,$sex,$type,$birthday,$chara,$gazo);

        unset($_SESSION['post_data']);
        $msg = $this->Out_Msg(2,$pet_name);
        header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");

      } else {
        $msg = "エラー";
        header("Location: ../view/error.php?msg={$msg}");
      }
    }
  }
?>
