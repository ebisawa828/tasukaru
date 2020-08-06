<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>助かるトップ画面</title>
  <link rel="stylesheet" type="text/css" href="./css/tasukaru_style.css" media="all" />
</head>

<body>
  <br><br>
  <!-- ロゴを左に挿入 -->
  <image src="./image/logo.png" width="20%">
  <!-- 助かる表示 -->
  <div class="form-tasukaru">助かる✋</div>
  <!-- バージョンファイル表示 -->
  <div class="form-ver"><?php include("./lst/version.list"); ?></div>

  <!-- 検索フォームの囲み線 -->
  <div class="form-sub">
    <!-- 電話番号検索 -->
    <div class="form-title">test3　　　　　　　　</div>
    <form action="./view/view_karte.php" method="POST" target="_blank">
      <div class="form-input-top">
        <div class="input-text-top"><input type="text" name="tel" autocomplete="off" style='ime-mode:disabled' required pattern='\d{10,11}' title='数字のみを入力'></div>
        <div class="submit-base"><input type="submit" value="検索" ></div>
      </div>
    </form>
    <br><br>
    <!-- 顧客番号検索 -->
    <div class="form-title">test2　　　　　　　　　</div>
    <form action="./view/view_karte.php" method="POST" target="_blank">
      <div class="form-input-top">
        <div class="input-text-top"><input type="text" name="cust_id" autocomplete="off" style='ime-mode:disabled' required pattern='\d{5}' title='5けたの数字のみを入力'></div>
        <div class="submit-base"><input type="submit" value="検索" ></div>
      </div>
    </form>
  </div>
  <br><br>

  <!-- 新規登録ボタン -->
  <div class="form-sub form-text-center submit-base">
    <a href=./view/view_create_cust.php target="_blank">新規お客様の登録</a>
  </div>
  <br><br>

</body>
</html>
