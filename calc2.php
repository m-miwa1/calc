<?php
    //計算機 表示された問題の解答を入力し、送信する画面
    //前画面からPOSTで値が飛んできていない場合は何も表示しない
    if (!empty($_POST["intDigit"])) :
        //問題桁数
        $intDigit = $_POST["intDigit"];
        //演算指定
        $intCalcMethod = 0;
        //問題として出題される値の最大値
        $maxDigit = 0;

        //出題する問題の値を格納する配列
        $arrayQuestionA = [];
        $arrayQuestionB = [];
        
        //問題の答えを確認する配列
        $arrayAnswer = [];
        //問題を格納する配列
        $arrayQuestion = [];

        require_once('const.php');
        
        //演算指定が未入力の場合、足し算とみなして1を格納
        if (empty($_POST['intCalcMethod'])) {
            $intCalcMethod = 1;
        } else {
        	//演算指定が片方・もしくは両方入力されていた場合、intCalcMethodに値を格納(足し算:1,引き算:2,両方:3)
            foreach ($_POST['intCalcMethod'] as $intCalc) {
                $intCalcMethod += $intCalc;
            }
        }

        //forで各配列に値を格納
        for ($x = 0; $x < NUMBER_QUESTION; $x++) {
            $arrayQuestionA[] = mt_rand(MIN_DIGIT,MAX_DIGIT[$intDigit]);
            $arrayQuestionB[] = mt_rand(MIN_DIGIT,MAX_DIGIT[$intDigit]);
        }
        
        //for内のifでintCalcMethodの値により足し算・引き算・両方(mt_rand()によってランダム)に分岐
        //$arrayAnswerに問題の答えを、$arrayQuestionに問題を格納する
        for ($i = 0; $i < NUMBER_QUESTION; $i++) {
            if ($intCalcMethod == 1) {
                $arrayAnswer[$i] = $arrayQuestionA[$i] + $arrayQuestionB[$i];
                $arrayQuestion[$i] = $arrayQuestionA[$i] . " + " . $arrayQuestionB[$i] . " = ";
            } elseif ($intCalcMethod == 2) {
                $arrayAnswer[$i] = $arrayQuestionA[$i] - $arrayQuestionB[$i];
                $arrayQuestion[$i] = $arrayQuestionA[$i] . " - " . $arrayQuestionB[$i] . " = ";
            } elseif (mt_rand(1,2) % 2 == 0) {
                $arrayAnswer[$i] = $arrayQuestionA[$i] - $arrayQuestionB[$i];
                $arrayQuestion[$i] = $arrayQuestionA[$i] . " - " . $arrayQuestionB[$i] . " = ";
            } else {
                $arrayAnswer[$i] = $arrayQuestionA[$i] + $arrayQuestionB[$i];
                $arrayQuestion[$i] = $arrayQuestionA[$i] . " + " . $arrayQuestionB[$i] . " = ";
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
<p>計算練習</p>
選択したのは<?php echo MIN_DIGIT ?>-<?php echo MAX_DIGIT[$intDigit] ?>までの問題です。<br>
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
<?php endif; ?>
</body>
</html>
