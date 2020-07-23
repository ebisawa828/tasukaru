<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>お客様カルテがありません</title>
  <link rel="stylesheet" type="text/css" href="../css/tasukaru_style.css" media="all" />
</head>

<body>
  <!-- メッセージ表示 -->
  <p class="form-errormsg"> <?php echo $_GET['msg']; ?> </p>
  <!-- 閉じるボタン -->
  <div class="form-title submit-close"><input type="button" onclick="window.close();" value="閉じる" /></div>

  <!-- 自動クローズ設定（20秒） -->
  <SCRIPT LANGUAGE="JavaScript">
    setTimeout("window.close()", 20000);
  </SCRIPT>
</body>
</html>
