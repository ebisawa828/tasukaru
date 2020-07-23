<?php
  require_once 'BaseClass.php';

  class User_List extends BaseClass
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

        //ペット情報がない場合
        if( empty($this->pet_list[0]['pet_id']) ) {
          $msg = $this->Out_Msg(13);
          header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");
          return;
        }
        //ペット情報加工
        $this->Proc_Pet(modify);

        return $this->user_list;

      //POSTは入力完了時
      } elseif(true == isset($_POST['cust_id'])) {
        $cust_id=$_POST['cust_id'];

        //エラー時に入力情報を保持するため、POST変数を代入
        $_SESSION['post_data'] = $_POST;

        //ペットの性格・特徴の行数チェック(７行まで。改行は６個まで)
        $i=0;
        while (! empty($_POST['pet_name'][$i])) {
          $chara = $_POST['chara'][$i];
          $pet_name = $_POST['pet_name'][$i];
          $birth_Y = $_POST['birth_Y'][$i];
          $birth_M = $_POST['birth_M'][$i];

          $number = mb_substr_count(nl2br($chara),'<br />');
          if($number > 6) {
            $msg = $this->Out_Msg(17);
            header("Location: ../view/view_mod_pet.php?id={$cust_id}&msg={$msg}");
            return;
          }
          //ペットの誕生月確認(年、月のどちらかが未入力の場合)
          if( empty($birth_Y) and (! empty($birth_M)) ) {
            $msg = $this->Out_Msg(19,$pet_name);
            header("Location: ../view/view_mod_pet.php?id={$cust_id}&msg={$msg}");
            return;
          } elseif ( ! empty($birth_Y) and ( empty($birth_M)) ) {
            $msg = $this->Out_Msg(19,$pet_name);
            header("Location: ../view/view_mod_pet.php?id={$cust_id}&msg={$msg}");
            return;
          }
          $i++;
        }

        //ペット情報更新
        $i=0;
        while (! empty($_POST['pet_name'][$i])) {
          $pet_id = htmlspecialchars($_POST['pet_id'][$i], ENT_QUOTES);
          $pet_name = htmlspecialchars($_POST['pet_name'][$i], ENT_QUOTES);
          $sex = htmlspecialchars($_POST['sex'][$i], ENT_QUOTES);
          $type = htmlspecialchars($_POST['type'][$i], ENT_QUOTES);
          //ペットの誕生日の日付は１日に固定
          $birthday = $_POST['birth_Y'][$i] . "-" . $_POST['birth_M'][$i] . "-01";
          $chara = htmlspecialchars($_POST['chara'][$i], ENT_QUOTES);
          $gazo = $_POST['gazo'][$i];
          $Result = $this->Mod_Pet($pet_id,$pet_name,$sex,$type,$birthday,$chara,$gazo);
          $i++;
        }

        unset($_SESSION['post_data']);
        $msg = $this->Out_Msg(3);
        header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");

      } else {
        $msg = "エラー";
        header("Location: ../view/error.php?msg={$msg}");
      }
    }
  }
?>
