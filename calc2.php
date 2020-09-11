<?php
//計算機 表示された問題の解答を入力し、送信する画面

require_once('const.php');

//前画面からPOSTで値が飛んできていない場合は何も表示しない
if (!isset($_POST["digit"])) {
    exit;
}

//問題桁数
$digit = htmlspecialchars($_POST["digit"]);
//演算指定する配列に使用する変数
$calcMethod = 0;
//問題として出題される値の最大値
$maxDigit = 0;
//出題する問題の値を格納する配列
$arrayQuestionA = [];
$arrayQuestionB = [];
//問題の答えを確認する配列
$arrayAnswer = [];
//問題を格納する配列
$arrayQuestion = [];

//演算指定が未入力の場合、1を格納
if (!isset($_POST['calcMethod'])) {
    $calcMethod = 1;
} else {
    foreach ($_POST['calcMethod'] as $intCalc) {
        $calcMethod += $intCalc;
    }
}

//forで各配列に値を格納
for ($x = 0; $x < NUMBER_QUESTION; $x++) {
    $arrayNumberA[] = mt_rand(MIN_DIGIT, MAX_DIGIT[$digit]);
    $arrayNumberB[] = mt_rand(MIN_DIGIT, MAX_DIGIT[$digit]);
}

for ($i = 0; $i < NUMBER_QUESTION; $i++) {
    switch($calcMethod){
        case ADDITION:
            $arrayAnswer[$i] = $arrayNumberA[$i] + $arrayNumberB[$i];
            $arrayQuestion[$i] = $arrayNumberA[$i] . " + " . $arrayNumberB[$i] . " = ";
            break;
        case SUBSTRACTION:
            $arrayAnswer[$i] = $arrayNumberA[$i] - $arrayNumberB[$i];
            $arrayQuestion[$i] = $arrayNumberA[$i] . " - " . $arrayNumberB[$i] . " = ";
            break;
        case ADDITION_SUBSTRACTION:
            if (boolRandam()) {
                $arrayAnswer[$i] = $arrayNumberA[$i] - $arrayNumberB[$i];
                $arrayQuestion[$i] = $arrayNumberA[$i] . " - " . $arrayNumberB[$i] . " = ";
            } else {
                $arrayAnswer[$i] = $arrayNumberA[$i] + $arrayNumberB[$i];
                $arrayQuestion[$i] = $arrayNumberA[$i] . " + " . $arrayNumberB[$i] . " = ";
            }
            break;
        default:
            exit;
            break;
    }
}

function boolRandam() {
    return mt_rand(1,2) % 2 == 0;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>研修計算機</title>
</head>
<body>
<p>計算練習</p>
選択したのは<?php echo MIN_DIGIT ?>-<?php echo MAX_DIGIT[$digit] ?>までの問題です。<br>
全部で5問出題します。
<p>
    <form action ="calc3.php" method ="post">

    <?php for ($index = 0; $index < NUMBER_QUESTION; $index++) : ?>

    <?php echo $index + 1 ?>問目  <?php echo $arrayQuestion[$index] ?> 

    <input type="number" name="arrayInputAnswer[]"><br>

    <?php endfor; ?>
    
    <!--$arrayAnswerと$arrayQuestionを配列のままPOSTで送信するため、serializeを行う -->
    <input type="hidden" name="arrayQuestion" value="<?php echo htmlentities(serialize($arrayQuestion)); ?>">
    <input type="hidden" name="arrayAnswer" value="<?php echo htmlentities(serialize($arrayAnswer)); ?>">
    <input type="submit" value="送信">
    <input type="reset" value="リセット"><br>
    </form>
</p>
</body>
</html>
