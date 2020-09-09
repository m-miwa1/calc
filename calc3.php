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
//問題と入力された解答、正誤を格納する配列
$arrayQuestionAndAnswer = [];

for($n = 0; $n < 5; $n++){
    $arrayQuestionAndAnswer[] = 
    $n + 1 . "問目  " . $arrayQuestion[$n] . htmlspecialchars($arrayInputAnswer[$n]);
    if ($arrayInputAnswer[$n] == $arrayAnswer[$n]) {
        $arrayQuestionAndAnswer[$n] .= "...正解<br>";
    } else {
        $arrayQuestionAndAnswer[$n] .= "...不正解。答えは" . $arrayAnswer[$n] . "<br>";
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
<?php foreach ($arrayQuestionAndAnswer as $questionAndAnswer) : ?>
<?php echo $questionAndAnswer ?>
<?php endforeach; ?>
</body>
</html>
