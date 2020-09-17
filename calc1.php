<?php
//計算機　問題の桁数と演算指定を入力し、送信する画面
require_once('const.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>研修計算機</title>
</head>
<body>
<hr>
どの範囲で出題しますか？<br>
<form action ="calc2.php" method ="post">
    <p>
        問題桁数<br>
        <input type="radio" name="digit" value="1" checked><?php echo MIN_DIGIT ?>-<?php echo MAX_DIGIT[1] ?>まで<br>
        <input type="radio" name="digit" value="2"><?php echo MIN_DIGIT ?>-<?php echo MAX_DIGIT[2] ?>まで
    </p>
    <p>
        演算指定（指定がないと足し算のみ行われます）<br>
        <input type="checkbox" name="calcMethod[]" value="<?php echo ADDITION ?>">足し算<br>
        <input type="checkbox" name="calcMethod[]" value="<?php echo SUBSTRACTION ?>">引き算<br>
        <input type="checkbox" name="calcMethod[]" value="<?php echo MULTIPLICATION ?>">掛け算<br>
    </p>
    <input type="submit" value="送信">
    <input type="reset" value="リセット"><br>
</form>
</body>
</html>