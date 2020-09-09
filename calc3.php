<?php
//計算機 問題の答えと入力された解答の答え合わせをする画面
//前画面からPOSTで値が飛んできていない場合は何も表示しない
if (empty($_POST["arrayInputAnswer"])) {
    exit;
}

//入力された問題の解答を格納する配列
$arrayInputAnswer = $_POST['arrayInputAnswer'];
//問題を格納する配列
$arrayQuestion = unserialize($_POST['arrayQuestion']);
//問題の答えを格納する配列
$arrayAnswer = unserialize($_POST['arrayAnswer']);
//問題と問題数を格納する配列
$arrayQuestionAndNumber = [];
//問題の正誤を格納する配列
$arrayCorrectness = [];

for($n = 0; $n < 5; $n++){
    $arrayQuestionAndNumber[] = $n + 1 . "問目  " . $arrayQuestion[$n];  ;
    if ($arrayInputAnswer[$n] == $arrayAnswer[$n]) {
        $arrayCorrectness[] = "...正解<br>";
    } else {
        $arrayCorrectness[] = "...不正解。答えは" . $arrayAnswer[$n] . "<br>";
    }
            
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>研修計算機</title>
</head>
<body>
<p>練習問題結果</p>
<?php for ($index = 0; $index < 5; $index++) : ?>
<?php echo $arrayQuestionAndNumber[$index] . htmlspecialchars($arrayInputAnswer[$index]) . $arrayCorrectness[$index]?>
<?php endfor; ?>
</body>
</html>
