<?php
//計算機 問題の答えと入力された解答の答え合わせをする画面

require_once('const.php');

//前画面からPOSTで値が飛んできていない場合は何も表示しない
if (!isset($_POST["arrayInputAnswer"]) || !isset($_POST["arrayQuestion"]) || !isset($_POST["arrayAnswer"])) {
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

for($n = 0; $n < NUMBER_QUESTION; $n++){
    $arrayQuestionAndNumber[] = $n + 1 . "問目  " . $arrayQuestion[$n];
    if ($arrayInputAnswer[$n] == $arrayAnswer[$n]) {
        $arrayQuestionAndNumber[$n] .= "...正解";
    } else {
        $arrayQuestionAndNumber[$n] .= "...不正解。答えは" . $arrayAnswer[$n];
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
<?php for ($index = 0; $index < NUMBER_QUESTION; $index++) : ?>
<?php echo htmlspecialchars($arrayQuestionAndNumber[$index]) . "<br>" ?>
<?php endfor; ?>
</body>
</html>
