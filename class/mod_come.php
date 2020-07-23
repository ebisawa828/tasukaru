<?php
  require_once 'BaseClass.php';

  class Com_Mod extends BaseClass
  {//ここはPHP全体の最初の枠
    public function main()
    {
      //GETは、メニューリストから選択時
      if(true == isset($_GET['id'])){
        $cust_id=$_GET['id'];

        //エラー時以外は、$_SESSIONを削除
        if(false == isset($_GET['msg'])) {
          unset($_SESSION['post_data']);
        }

        //ユーザリスト取得
        $this->user_list = $this->Get_User_list($cust_id);
        //お客様情報の加工
        $this->Proc_Cust(display);

        //利用履歴リスト取得
        $this->come_list = $this->Get_Come_list($cust_id);

        //利用履歴がない場合
        if( empty($this->come_list[0]['come_id']) ) {
          $msg = $this->Out_Msg(14);
          header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");
          return;
        }

       return $this->user_list;

       //POSTは更新画面から（変更完了）
      } elseif(true == isset($_POST['cust_id'])) {
        $cust_id=$_POST['cust_id'];

        //エラー時に入力情報を保持するため、POST変数を代入
        $_SESSION['post_data'] = $_POST;

        //内容欄の行数チェック(5行まで。改行は4個まで)
        $i=0;
        while (! empty($_POST['come_id'][$i])) {
          $chara = $_POST['content'][$i];
          $number = mb_substr_count(nl2br($chara),'<br />');
          if($number > 4) {
            $msg = $this->Out_Msg(18);
            header("Location: ../view/view_mod_come.php?id={$cust_id}&msg={$msg}");
            return;
          }
          $i++;
        }

        //利用履歴更新
        $i=0;
        while (! empty($_POST['come_id'][$i])) {
          $come_id = htmlspecialchars($_POST['come_id'][$i], ENT_QUOTES);
          $str_date = htmlspecialchars($_POST['str_date'][$i], ENT_QUOTES);
          $end_date = htmlspecialchars($_POST['end_date'][$i], ENT_QUOTES);
          $course = $_POST['course'][$i];
          $content = htmlspecialchars($_POST['content'][$i], ENT_QUOTES);
          $price = htmlspecialchars($_POST['price'][$i], ENT_QUOTES);
          $staff = htmlspecialchars($_POST['staff'][$i], ENT_QUOTES);
          $cut_time = htmlspecialchars($_POST['cut_time'][$i], ENT_QUOTES);
          $Result = $this->Mod_Come($come_id,$str_date,$end_date,$course,$content,$price,$staff,$cut_time);

          $i++;
        }

        unset($_SESSION['post_data']);
        $msg = $this->Out_Msg(5);
        header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");

      } else {
        $msg = "エラー";
        header("Location: ../view/error.php?msg={$msg}");
      }
    }
  } //ここはPHP全体の最後の枠(ここより上に関数を入れること)
?>
