<?php
abstract class BaseClass
{
  protected $data = array();
  abstract protected function main();
  //テーブル定義
  const User_table = 'test_tasukaru_cust_tbl';
  const Pet_table = 'test_tasukaru_pet_tbl';
  const Come_table = 'test_tasukaru_come_tbl';

  public function __construct()
  {
    $this->connectDb();
    $date = new DateTime();
    $this->date = $date->format('Ym');
    $this->date2 = $date->format('m');
    session_start();

    //Enterキーを無効化する(2020/11/30追加) ?>
    <script language="javascript" type="text/javascript">
      document.onkeypress = enter;
      function enter(){
        if( window.event.keyCode == 13 ){
          if (event.srcElement.type != 'submit' && event.srcElement.type != 'textarea') {
              // submitボタン、テキストエリア以外の場合はイベントをキャンセル
              return false;
          }
        }
      }
    </script>
<?php

  }

  //DB接続
  protected function connectDb()
  {
    try{
      $this->pdo=new PDO('mysql:host=localhost;dbname=eyeluck;charset=utf8','eyeluck','d9wABDcTLLuQ');
      array(PDO::ATTR_EMULATE_PREPARES => false);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR: . $db_msg";
    }
  }

  //sql実行（結果取得）
  public function get_query($sql, array $params = array())
  {
    $stmt = $this->pdo->prepare($sql);
    if ($params != null) {
      foreach ($params as $key => $val) {
        $stmt->bindValue(':' . $key, $val, PDO::PARAM_STR);
      }
    }
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  //sql実行(引数を数値指定)
  public function num_query($sql, array $params = array())
  {
    $stmt = $this->pdo->prepare($sql);
    if ($params != null) {
      foreach ($params as $key => $val) {
        $stmt->bindValue(':' . $key, $val, PDO::PARAM_INT);
      }
    }
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  //sql実行（更新）
  public function exec_query($sql, array $params = array())
  {
    $stmt = $this->pdo->prepare($sql);
    if ($params != null) {
      foreach ($params as $key => $val) {
        $stmt->bindValue(':' . $key, $val, PDO::PARAM_STR);
      }
    }
    $result = $stmt->execute();
    return $result;
  }

  //メッセージリストからのメッセージ生成
  public function Out_Msg($no,$par = "")
  {
    $msg_lst = '../lst/message.list';
    $fp_msg = fopen($msg_lst, 'r');
    while ($msg_csv = fgetcsv($fp_msg)) {
      //csvの２カラム目（メッセージ）を格納
      $i = $msg_csv[0];
      $this->out_msg[$i] = $msg_csv[1];
    }
    fclose($fp_ex);

    if( ! empty($par)) {
      return str_replace(MSG,$par,$this->out_msg[$no]);
    } else {
      return $this->out_msg[$no];
    }
  }

  //お客様情報取得(ID)
  public function Get_User_list($id)
  {
    $user_list = array();
    $params = array('id' => $id);
    try{
      $sql = sprintf('SELECT * FROM %s where cust_id = :id',self::User_table);
      //LIMIT対応（数値用クエリ）
      $user_list = $this->get_query($sql, $params);
      return $user_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //お客様の存在チェック（顧客番号）
  public function User_Chk($id)
  {
    $User_Result = array();
    try{
      $params = array('id' => $id);
      $sql = sprintf('SELECT cust_id from %s where cust_id = :id',self::User_table);
      $User_Result = $this->get_query($sql, $params);
      return $User_Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //電話番号からお客様の存在確認
  public function Get_User_id($tel)
  {
    $user_id = array();
    $params = array('tel' => $tel);
    try{
      $sql = sprintf('SELECT cust_id FROM %s where tel_1 = :tel or tel_2 = :tel or tel_3 = :tel or tel_4 = :tel',self::User_table);
      //LIMIT対応（数値用クエリ）
      $user_id = $this->num_query($sql, $params);
      return $user_id;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //お客様登録
  public function Add_Cust($name,$name_f,$cust_id,$create_date,$address,$doui,$tel_1,$tel_2,$tel_3,$tel_4,$tel_1_m,$tel_2_m,$tel_3_m,$tel_4_m,$comment,$sec_1,$sec_2,$sec_3)
  {
    try{
      $params = array('name' => $name, 'name_f' => $name_f, 'cust_id' => $cust_id, 'create_date' => $create_date, 'address' => $address,'doui' => $doui,
        'tel_1' => $tel_1,'tel_2' => $tel_2,'tel_3' => $tel_3,'tel_4' => $tel_4,'tel_1_m' => $tel_1_m,'tel_2_m' => $tel_2_m,'tel_3_m' => $tel_3_m,'tel_4_m' => $tel_4_m,
        'comment' => $comment,'sec_1' => $sec_1,'sec_2' => $sec_2,'sec_3' => $sec_3);
      $sql = sprintf('INSERT INTO %s (name, name_f, cust_id, create_date, address, doui, tel_1, tel_2, tel_3, tel_4, tel_1_m, tel_2_m, tel_3_m, tel_4_m, comment,sec_1 ,sec_2 ,sec_3)
        VALUES (:name, :name_f, :cust_id, :create_date, :address, :doui, :tel_1, :tel_2, :tel_3, :tel_4, :tel_1_m, :tel_2_m, :tel_3_m, :tel_4_m, :comment, :sec_1, :sec_2, :sec_3)',self::User_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      echo "ERROR1:$db_msg";
      exit;
    }
  }

  //お客様情報更新
  public function Mod_Cust($name,$name_f,$cust_id,$address,$doui,$tel_1,$tel_2,$tel_3,$tel_4,$tel_1_m,$tel_2_m,$tel_3_m,$tel_4_m,$comment,$sec_1,$sec_2,$sec_3)
  {
    try{
      $params = array('name' => $name, 'name_f' => $name_f,'cust_id' => $cust_id, 'address' => $address,'doui' => $doui,'tel_1' => $tel_1,'tel_2' => $tel_2,'tel_3' => $tel_3,'tel_4' => $tel_4,
        'tel_1_m' => $tel_1_m,'tel_2_m' => $tel_2_m,'tel_3_m' => $tel_3_m,'tel_4_m' => $tel_4_m,'comment' => $comment,'sec_1' => $sec_1,'sec_2' => $sec_2,'sec_3' => $sec_3);
      $sql = sprintf('UPDATE %s set name = :name, name_f = :name_f, address = :address, doui = :doui, tel_1 = :tel_1, tel_2 = :tel_2, tel_3 = :tel_3, tel_4 = :tel_4,
        tel_1_m = :tel_1_m, tel_2_m = :tel_2_m, tel_3_m = :tel_3_m, tel_4_m = :tel_4_m,comment = :comment, sec_1 = :sec_1, sec_2 = :sec_2, sec_3 = :sec_3 where cust_id = :cust_id',self::User_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      echo "ERROR1:$db_msg";
      exit;
    }
  }

  //お客様情報の加工(表示用と修正用を引数で分ける)
  public function Proc_Cust($div)
  {
    foreach ($this->user_list as $key=>$val) {
      foreach ($this->user_list[$key] as $key2 => $val2) {
        //登録・修正共通
        if($key2 == 'create_date') {
          $this->user_list[$key][$key2] = substr($val2,0,4) . "年" . substr($val2,5,2) . "月" . substr($val2,8,2) . "日";
        }

        //表示時のみ
        if($div == "display") {
          //備考に改行を挿入
          if($key2 == 'comment') {
            $this->user_list[$key][$key2] = nl2br($val2);
          //住所に改行を挿入
          } elseif($key2 == 'address') {
            $this->user_list[$key][$key2] = nl2br($val2);
          //年・月を追加
          //電話番号のメモに記載がある場合にカッコをつける
          } elseif($key2 == 'tel_1_m' && ! empty($this->user_list[$key]['tel_1']) && ! empty($val2) ) {
            $this->user_list[$key][$key2] = "(" . $val2 . ")";
          } elseif($key2 == 'tel_2_m' && ! empty($this->user_list[$key]['tel_2']) && ! empty($val2) ) {
            $this->user_list[$key][$key2] = "(" . $val2 . ")";
          } elseif($key2 == 'tel_3_m' && ! empty($this->user_list[$key]['tel_3']) && ! empty($val2) ) {
            $this->user_list[$key][$key2] = "(" . $val2 . ")";
          } elseif($key2 == 'tel_4_m' && ! empty($this->user_list[$key]['tel_4']) && ! empty($val2) ) {
            $this->user_list[$key][$key2] = "(" . $val2 . ")";
          }
        //修正時のみ
        } elseif($div == "modify") {
          if($key2 == 'doui') {
            if($val2 == "●") {
              $this->user_list[$key]['checked'] = "checked=checked";
            }
          }
        }
      }
    }
  }

  //お客様情報削除(2020/11/30追加)
  public function Del_Cust($cust_id)
  {
    try{
       $params = array('cust_id' => $cust_id );
       $sql = sprintf('DELETE FROM %s where cust_id = :cust_id', self::User_table);
       $Result = $this->exec_query($sql, $params);
       return $Result;
    } catch (PDOException $e) {
       $db_msg = $e->getMessage();
       return "ERROR1:$db_msg";
    }
  }

  //お客様登録件数取得(2020/12/14追加)
  public function Get_Cust_Count()
  {
    try{
       $params = array();
       $sql = sprintf('SELECT count(*) as count FROM %s', self::User_table);
       $user_count_tmp = $this->get_query($sql, $params);
       return $user_count_tmp[0]['count'];
    } catch (PDOException $e) {
       $db_msg = $e->getMessage();
       return "ERROR1:$db_msg";
    }
  }

  //お客様一覧取得
  public function Get_Cust_come_all_list()
  {
    $come_list = array();
    $params = array();
    try{
      $sql = sprintf('SELECT %s.cust_id as cust_id, name, count(*) as num, max(str_date) as last_date FROM %s
        inner join %s on %s.cust_id = %s.cust_id group by cust_id order by cust_id;'
        ,self::Come_table,self::Come_table, self::User_table, self::Come_table, self::User_table);
      $come_list = $this->get_query($sql, $params);
      return $come_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //特定日のお客様取得
  public function Get_Cust_dayly_list($t_day)
  {
    $user_list = array();
    $params = array('t_day' => $t_day);
    try{
        $sql = sprintf('SELECT distinct cust_id FROM %s where str_date = :t_day order by cust_id;' ,self::Come_table);
      $user_list = $this->get_query($sql, $params);
      return $user_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //利用履歴一覧取得(日付指定)
  public function Get_Cust_come_dayly_list($cust_id,$t_day)
  {
    $user_list = array();
    $params = array('cust_id' => $cust_id, 't_day' => $t_day);
    try{
        //$sql = sprintf('SELECT %s.cust_id as cust_id, name, count(*) as num, max(str_date) as last_date FROM %s
        //  inner join %s on %s.cust_id = %s.cust_id where %s.cust_id
        //  in ( select cust_id from %s where str_date = :t_day ) group by cust_id order by cust_id;'
        //  ,self::Come_table,self::Come_table, self::User_table, self::Come_table, self::User_table, self::Come_table, self::Come_table);

        //処理が遅いのでサブクエリ削除
        //$sql = sprintf('SELECT %s.cust_id as cust_id, name, count(*) as num, max(str_date) as last_date FROM %s
        //  inner join %s on %s.cust_id = %s.cust_id where %s.cust_id = :cust_id group by cust_id ;'
        //  ,self::Come_table,self::Come_table, self::User_table, self::Come_table, self::User_table, self::Come_table);

        //日付指定日より前回の利用日を取得に変更
        $sql = sprintf('SELECT %s.cust_id as cust_id, name, count(*) as num,
          (select max(str_date) from %s where cust_id = :cust_id and str_date < :t_day ) as last_date FROM %s
          inner join %s on %s.cust_id = %s.cust_id where %s.cust_id = :cust_id group by cust_id ;'
          ,self::Come_table,self::Come_table,self::Come_table, self::User_table, self::Come_table, self::User_table, self::Come_table);

      $user_list = $this->get_query($sql, $params);
      return $user_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }


  //ペット  --------------------------------------------------------------------------------------------------------------
  //ペット情報取得
  public function Get_Pet_list($id)
  {
    $pet_list = array();
    $params = array('id' => $id);
    try{
      $sql = sprintf('SELECT * FROM %s where cust_id = :id and del_flg is NULL LIMIT 4',self::Pet_table);
      //LIMIT対応（数値用クエリ）
      $pet_list = $this->get_query($sql, $params);
      return $pet_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //ペット登録
  public function Add_Pet($pet_name,$cust_id,$sex,$type,$birthday,$chara,$gazo)
  {
    try{
      $params = array('pet_name' => $pet_name, 'cust_id' => $cust_id, 'sex' => $sex, 'type' => $type,'birthday' => $birthday,'chara' => $chara,'gazo' => $gazo);
      $sql = sprintf('INSERT INTO %s (pet_name, cust_id, sex, type, birthday, comment, gazo) VALUES (:pet_name, :cust_id, :sex, :type, :birthday, :chara, :gazo)',self::Pet_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      echo "ERROR1:$db_msg";
      exit;
    }
  }

  //ペット情報更新
  public function Mod_Pet($pet_id,$pet_name,$sex,$type,$birthday,$chara,$gazo)
  {
    try{
      $params = array('pet_id' => $pet_id, 'pet_name' => $pet_name, 'sex' => $sex, 'type' => $type,'birthday' => $birthday,'chara' => $chara,'gazo' => $gazo);
      $sql = sprintf('UPDATE %s set pet_name = :pet_name, sex = :sex, type = :type, birthday = :birthday, comment = :chara, gazo = :gazo where pet_id = :pet_id',self::Pet_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      echo "ERROR1:$db_msg";
      exit;
    }
  }

  //ペット情報の加工(表示用と修正用を引数で分ける)
  public function Proc_Pet($div)
  {
    foreach ($this->pet_list as $key=>$val) {
      foreach ($this->pet_list[$key] as $key2 => $val2) {
        //表示時
        if($div == "display") {
          //誕生日から年齢を算出
          if($key2 == 'birthday') {
            //誕生日がないの場合は、デフォルト"0000-00-00"を空にする
            if($val2 == "0000-00-00") {
              $this->pet_list[$key][$key2] ="";
            } else {
              $birthday_tmp=str_replace('-','',$val2);
              $birthday=substr($birthday_tmp, 0, 6);
              $birthday2=substr($birthday, 4, 2);
              $age=floor(($this->date - $birthday)/100);
              $age2=floor(($this->date2 - $birthday2));
              if ($age2 < 0){
               $age2 = $age2 + 12;
              }
              $this->pet_age[$key]['age'] = $age . "歳" . $age2 . "ヶ月" ;
              $this->pet_list[$key][$key2] = substr($birthday, 0, 4) . "年" . substr($birthday, 4, 2) . "月";
            }

          //性格・特徴に改行を表示
          } elseif($key2 == 'comment') {
            $this->pet_list[$key][$key2] = nl2br($val2);
          //画像がある場合の表示設定
          } elseif($key2 == 'gazo') {
            if( ! empty($val2) ) {
              //印刷の場合は、ありを設定
              if(true == isset($_GET['print'])) {
                $this->dis[$key] = "あり";
              //表示の場合は、ボタンを表示
              } else {
                $this->dis[$key] = "<div class=\"submit-gazo\"><a href=\"" . $val2 . "\" target=\"_blank\">表示</div>";
              }
            } else {
              $this->dis[$key] = "なし";
            }
          }

        //修正時
        } elseif($div == "modify") {
          if($key2 == 'birthday') {
            //設定した誕生日(日付は1日に固定)から年と月を取得
            if(! empty($val2)) {
              //登録していない場合"0000-00-00"になるので、空にする
              if(substr($val2,0,4) == "0000") {
                $this->pet_list[$key]['birth_Y'] = "";
                $this->pet_list[$key]['birth_M'] = "";
              } else {
                $this->pet_list[$key]['birth_Y'] = substr($val2,0,4);
                $this->pet_list[$key]['birth_M'] = substr($val2,5,2);
              }
            }

          //性別を設定
          } elseif($key2 == 'sex') {
            if($val2 == '♂') {
              $this->checked[$key]['checked_osu'] = "checked=checked";
              $this->checked[$key]['checked_mesu'] = "";
            } elseif($val2 == '♀') {
              $this->checked[$key]['checked_osu'] = "";
              $this->checked[$key]['checked_mesu'] = "checked=checked";
            }
          }
        }
      }
    }
  }

  //お客様削除時のペット情報削除(2020/11/30追加)
  public function Del_Pet_Cust($cust_id)
  {
    try{
       $params = array('cust_id' => $cust_id );
       $sql = sprintf('DELETE FROM %s where cust_id = :cust_id', self::Pet_table);
       $Result = $this->exec_query($sql, $params);
       return $Result;
    } catch (PDOException $e) {
       $db_msg = $e->getMessage();
       return "ERROR1:$db_msg";
    }
  }

  //ペット情報削除(2020/11/30追加)
  public function Del_Pet($pet_id)
  {
    try{
       $params = array('pet_id' => $pet_id );
       $sql = sprintf('DELETE FROM %s where pet_id = :pet_id', self::Pet_table);
       $Result = $this->exec_query($sql, $params);
       return $Result;
    } catch (PDOException $e) {
       $db_msg = $e->getMessage();
       return "ERROR1:$db_msg";
    }
  }

  //ペットの名前取得(2020/11/30追加)
  public function Get_Pet_name($pet_id)
  {
    $pet_list = array();
    $params = array('id' => $pet_id);
    try{
      $sql = sprintf('SELECT * FROM %s where pet_id = :id and del_flg is NULL',self::Pet_table);
      //LIMIT対応（数値用クエリ）
      $pet_list = $this->get_query($sql, $params);
      return $pet_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //ペット登録件数取得(2020/12/14追加)
  public function Get_Pet_Count()
  {
    try{
       $params = array();
       $sql = sprintf('SELECT count(*) as count FROM %s', self::Pet_table);
       $pet_count_tmp = $this->get_query($sql, $params);
       return $pet_count_tmp[0]['count'];
    } catch (PDOException $e) {
       $db_msg = $e->getMessage();
       return "ERROR1:$db_msg";
    }
  }


  //利用履歴  --------------------------------------------------------------------------------------------------------------
  //利用履歴の取得
  public function Get_Come_list($id)
  {
    $come_list = array();
    $params = array('id' => $id);
    try{
      $sql = sprintf('SELECT * FROM %s where cust_id = :id ORDER BY str_date DESC LIMIT 8',self::Come_table);
      //LIMIT対応（数値用クエリ）
      $come_list = $this->get_query($sql, $params);
      return $come_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //利用履歴登録
  public function Add_Come($str_date,$end_date,$cust_id,$course,$content,$price,$staff,$cut_time)
  {
    try{
      $params = array('str_date' => $str_date, 'end_date' => $end_date, 'cust_id' => $cust_id, 'course' => $course,'content' => $content,'price' => $price,'staff' => $staff,'cut_time' => $cut_time);
      $sql = sprintf('INSERT INTO %s (str_date, end_date,cust_id, course, content, price, staff, cut_time) VALUES (:str_date, :end_date, :cust_id, :course, :content, :price, :staff, :cut_time)',self::Come_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      echo "ERROR1:$db_msg";
      exit;
    }
  }

  //利用履歴更新
  public function Mod_Come($come_id,$str_date,$end_date,$course,$content,$price,$staff,$cut_time)
  {
    try{
      $params = array('come_id' => $come_id, 'str_date' => $str_date, 'end_date' => $end_date, 'course' => $course, 'content' => $content,'price' => $price,'staff' => $staff,'cut_time' => $cut_time);
      $sql = sprintf('UPDATE %s set str_date = :str_date, end_date = :end_date, course = :course, content = :content, price = :price, staff = :staff, cut_time = :cut_time where come_id = :come_id',self::Come_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      echo "ERROR1:$db_msg";
      exit;
    }
  }

  //ご利用履歴の加工(表示用と修正用を引数で分ける)
  public function Proc_Come($div)
  {
    foreach ($this->come_list as $key=>$val) {
      foreach ($this->come_list[$key] as $key2 => $val2) {
        //表示時
        if($div == "display") {
          //利用開始日と終了日を結合
          if($key2 == 'str_date') {
            $this->come_list[$key][$key2] = $val2 . "<br>  &nbsp ～ &nbsp <br>" . $this->come_list[$key]['end_date'] ;
            //内容に改行を挿入
          } elseif($key2 == 'content') {
            $this->come_list[$key][$key2] = nl2br($val2);
          }
        }
      }
    }
  }

  //お客様削除時のご利用履歴削除(2020/11/30追加)
  public function Del_Come_Cust($cust_id)
  {
    try{
      $params = array('cust_id' => $cust_id );
      $sql = sprintf('DELETE FROM %s where cust_id = :cust_id', self::Come_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //ご利用履歴削除(2020/11/30追加)
  public function Del_Come($come_id)
  {
    try{
      $params = array('come_id' => $come_id );
      $sql = sprintf('DELETE FROM %s where come_id = :come_id', self::Come_table);
      $Result = $this->exec_query($sql, $params);
      return $Result;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //ご利用履歴登録件数取得(2020/12/14追加)
  public function Get_Come_Count()
  {
    try{
       $params = array();
       $sql = sprintf('SELECT count(*) as count FROM %s', self::Come_table);
       $come_count_tmp = $this->get_query($sql, $params);
       return $come_count_tmp[0]['count'];
    } catch (PDOException $e) {
       $db_msg = $e->getMessage();
       return "ERROR1:$db_msg";
    }
  }

  //お客様別利用履歴取得
  public function Get_dayly_come_list()
  {
    $user_list = array();
    $params = array();
    try{
      $sql = sprintf('SELECT DATE_FORMAT(str_date, %s) as str_date, count(*) as num FROM %s group by str_date order by str_date DESC', "'%Y-%m-%d'",self::Come_table);
      $user_list = $this->get_query($sql, $params);
      return $user_list;
    } catch (PDOException $e) {
      $db_msg = $e->getMessage();
      return "ERROR1:$db_msg";
    }
  }

  //カレンダーの色を設定
  public function color_get($i) {
    if ($i == 0) return '#ff0000'; elseif ($i == 6) return '#0000ff'; else return '#000000';
  }

}
?>
