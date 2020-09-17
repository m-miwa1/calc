<?php
//計算機 表示された問題の解答を入力し、送信する画面

require_once('const.php');

//前画面からPOSTで値が飛んできていない場合は何も表示しない
if (!isset($_POST["digit"])) {
    exit;
}

//問題桁数
$digit = htmlspecialchars($_POST["digit"]);
//演算指定する配列
$calcMethod = [];
//問題として出題される値の最大値
$maxDigit = 0;
//出題する問題の値を格納する配列
$arrayQuestionA = [];
$arrayQuestionB = [];

//演算指定が未入力の場合、1を格納
if (!isset($_POST['calcMethod'])) {
    $calcMethod[0] = ADDITION;
} else {
    $calcMethod = $_POST['calcMethod'];
}

//forで各配列に値を格納
for ($x = 0; $x < NUMBER_QUESTION; $x++) {
    $arrayNumberA[] = mt_rand(MIN_DIGIT, MAX_DIGIT[$digit]);
    $arrayNumberB[] = mt_rand(MIN_DIGIT, MAX_DIGIT[$digit]);
}

//生成した問題と解答をそれぞれの配列に格納
list ($arrayQuestion,$arrayAnswer) = createQuestion(NUMBER_QUESTION,$calcMethod,$arrayNumberA,$arrayNumberB);

//問題と解答を返すメソッド
function createQuestion($numberQuestion, $calcMethod, $arrayNumberA, $arrayNumberB) {
    $arrayAnswer = [];
    $arrayQuestion = [];
    for ($i = 0; $i < $numberQuestion; $i++) {
        while (1) {
            $random = mt_rand();
            if ($random % MULTIPLICATION === 0 && in_array(MULTIPLICATION,$calcMethod)) {
                $arrayAnswer[$i] = $arrayNumberA[$i] * $arrayNumberB[$i];
                $arrayQuestion[$i] = $arrayNumberA[$i] . " × " . $arrayNumberB[$i] . " = ";
                break;
            } else if ($random % SUBSTRACTION === 0 && in_array(SUBSTRACTION,$calcMethod)) {
                $arrayAnswer[$i] = $arrayNumberA[$i] - $arrayNumberB[$i];
                $arrayQuestion[$i] = $arrayNumberA[$i] . " - " . $arrayNumberB[$i] . " = ";
                break;
            } else if ($random % ADDITION === 0 && in_array(ADDITION,$calcMethod)) {
                $arrayAnswer[$i] = $arrayNumberA[$i] + $arrayNumberB[$i];
                $arrayQuestion[$i] = $arrayNumberA[$i] . " + " . $arrayNumberB[$i] . " = ";
                break;
            }
        }
    }
    return [$arrayQuestion, $arrayAnswer];
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

    <?php echo $index + 1 ?>問目  <?php echo htmlspecialchars($arrayQuestion[$index]) ?> 

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
