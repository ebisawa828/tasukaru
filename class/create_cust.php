<?php
  require_once 'BaseClass.php';

  class Create_Cust extends BaseClass
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function main()
    {
      //登録するボタンを押した時
      if(true == isset($_POST['cust_id'])){
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $name_f = htmlspecialchars($_POST['name_f'], ENT_QUOTES);
        $cust_id = htmlspecialchars($_POST['cust_id'], ENT_QUOTES);
        $create_date = htmlspecialchars($_POST['create_date'], ENT_QUOTES);
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
        $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES);
        $sec_1 = htmlspecialchars($_POST['sec_1'], ENT_QUOTES);
        $sec_2 = htmlspecialchars($_POST['sec_2'], ENT_QUOTES);
        $sec_3 = htmlspecialchars($_POST['sec_3'], ENT_QUOTES);

        //エラー時に入力情報を保持するため、POST変数を代入
        $_SESSION['post_data'] = $_POST;

        //お客様番号の存在チェック
        $Chk_Result = $this->User_Chk($cust_id);
        if(! empty($Chk_Result)) {
          //既にお客さま番号が存在する場合
          $msg = $this->Out_Msg(11,$cust_id);
          header("Location: ../view/view_create_cust.php?msg={$msg}");
          return;
        }

        //住所欄の行数チェック(2行まで。改行は1個まで)
        $number = mb_substr_count(nl2br($address),'<br />');
        if($number > 1) {
          $msg = $this->Out_Msg(15);
          header("Location: ../view/view_create_cust.php?msg={$msg}");
          return;
        }

        //備考欄の行数チェック(７行まで。改行は６個まで)
        $number = mb_substr_count(nl2br($comment),'<br />');
        if($number > 6) {
          $msg = $this->Out_Msg(16);
          header("Location: ../view/view_create_cust.php?msg={$msg}");
          return;
        }
        //ペットの入力チェック
        $i=0;
        while (! empty($_POST['pet_name'][$i])) {
          $chara = $_POST['chara'][$i];
          $pet_name = $_POST['pet_name'][$i];
          $birth_Y = $_POST['birth_Y'][$i];
          $birth_M = $_POST['birth_M'][$i];
          //ペットの性格・特徴の行数チェック(７行まで。改行は６個まで)
          $number = mb_substr_count(nl2br($chara),'<br />');
          if($number > 6) {
            $msg = $this->Out_Msg(17);
            header("Location: ../view/view_create_cust.php?msg={$msg}");
            return;
          }
          //ペットの誕生月確認(年、月のどちらかが未入力の場合)
          if( empty($birth_Y) and (! empty($birth_M)) ) {
            $msg = $this->Out_Msg(19,$pet_name);
            header("Location: ../view/view_create_cust.php?msg={$msg}");
            return;
          } elseif ( ! empty($birth_Y) and ( empty($birth_M)) ) {
            $msg = $this->Out_Msg(19,$pet_name);
            header("Location: ../view/view_create_cust.php?msg={$msg}");
            return;
          }
          $i++;
        }

        //お客様登録
        $Result = $this->Add_Cust($name,$name_f,$cust_id,$create_date,$address,$doui,$tel_1,$tel_2,$tel_3,$tel_4,$tel_1_m,$tel_2_m,$tel_3_m,$tel_4_m,$comment,$sec_1,$sec_2,$sec_3);

        //ペット登録（最大４匹）
        $i=0;
        while (! empty($_POST['pet_name'][$i])) {
          $pet_name = htmlspecialchars($_POST['pet_name'][$i], ENT_QUOTES);
          $sex = htmlspecialchars($_POST['sex'][$i], ENT_QUOTES);
          $type = htmlspecialchars($_POST['type'][$i], ENT_QUOTES);
          //ペットの誕生日の日付は１日に固定
          $birthday = $_POST['birth_Y'][$i] . "-" . $_POST['birth_M'][$i] . "-01";
          $chara = htmlspecialchars($_POST['chara'][$i], ENT_QUOTES);
          $gazo = $_POST['gazo'][$i];
          $Result = $this->Add_Pet($pet_name,$cust_id,$sex,$type,$birthday,$chara,$gazo);
          //$msg = $msg . "ペット (" . $pet_name . ") を登録しました" . "<br>";
          $i++;
        }

        unset($_SESSION['post_data']);
        $msg = $this->Out_Msg(0,$name);
        header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");

      //GETでmsgがセットされていない場合は、登録ボタンを押したとき。念のためセッション変数をリセット
      //msgがセットされている場合は、誤入力時の再表示
      } elseif(false == isset($_GET['msg'])) {
        unset($_SESSION['post_data']);
      }
    }
  }
?>
