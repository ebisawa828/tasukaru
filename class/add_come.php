<?php
  require_once 'BaseClass.php';

 class Come_Upload extends BaseClass
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
        //お客様リスト取得
        $this->user_list = $this->Get_User_list($cust_id);
        //お客様情報の加工
        $this->Proc_Cust(display);

        //利用履歴取得
        $this->come_list = $this->Get_Come_list($cust_id);
        //ご利用履歴の加工
        $this->Proc_Come(display);

        return $this->user_list;

      //POSTは修正後の登録ボタン押下時
      } elseif(true == isset($_POST['cust_id'])) {
        $str_date = htmlspecialchars($_POST['str_date'], ENT_QUOTES);
        $end_date = htmlspecialchars($_POST['end_date'], ENT_QUOTES);
        $cust_id = htmlspecialchars($_POST['cust_id'], ENT_QUOTES);
        $course = $_POST['course'];
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES);
        $price= htmlspecialchars($_POST['price'], ENT_QUOTES);
        $staff= htmlspecialchars($_POST['staff'], ENT_QUOTES);
        $cut_time= htmlspecialchars($_POST['cut_time'], ENT_QUOTES);

        //エラー時に入力情報を保持するため、POST変数を代入
        $_SESSION['post_data'] = $_POST;

        //内容欄の行数チェック(5行まで。改行は4個まで)
        $number = mb_substr_count(nl2br($content),'<br />');
        if($number > 4) {
          $msg = $this->Out_Msg(18);
          header("Location: ../view/view_add_come.php?id={$cust_id}&msg={$msg}");
          return;
        }
        //利用履歴追加
        $Result = $this->Add_Come($str_date,$end_date,$cust_id,$course,$content,$price,$staff,$cut_time);

        unset($_SESSION['post_data']);
        $msg = $this->Out_Msg(4);
        header("Location: ../view/view_karte.php?id={$cust_id}&msg={$msg}");
      }
    }
  }
?>
