<!-- 計算機　表示された問題の解答を入力し、送信する画面 -->
<?php
	//前画面からPOSTで値が飛んできていない場合は何も表示しない
    if (!empty($_POST["intDigit"])) :
    	
        //問題桁数
        $intDigit = $_POST["intDigit"];
        //演算指定
        $intCalcMethod = 0;
        
        //問題として出題される数字の最小値
        define('ONEDIGIT', '0'); 
        
        //問題の出題数を格納する定数
        define('NUMBERQUESTION', '5'); 
        
        //出題する問題の値を格納する配列
        $arrayQuestionA = [];
        $arrayQuestionB = [];
        
        //問題の答えを確認する配列
        $arrayAnswer = [];
        //問題を格納する配列
        $arrayQuestion = [];
        
        //演算指定が未入力の場合、足し算とみなして1を格納
        if (empty($_POST['intCalcMethod'])) {
            $intCalcMethod = 1;
        } else {
        	//演算指定が片方・もしくは両方入力されていた場合、intCalcMethodに値を格納(足し算:1,引き算:2,両方:3)
            foreach ($_POST['intCalcMethod'] as $intCalc) {
                $intCalcMethod += $intCalc;
            }
        }
        
        if ($intDigit == 1) {
            //問題として出題される数字の最大値
            define('RANDDIGIT', '9');
        } else {
            //$strDigitKeyword = "0-99";
            define('RANDDIGIT', '99');
        }
        
        
        //forで各配列に値を格納
        for ($x = 0; $x < NUMBERQUESTION; $x++) {
            $arrayQuestionA[] = mt_rand(ONEDIGIT,RANDDIGIT);
            $arrayQuestionB[] = mt_rand(ONEDIGIT,RANDDIGIT);
        }
        
        //for内のifでintCalcMethodの値により足し算・引き算・両方(mt_rand()によってランダム)に分岐
        //$arrayAnswerに問題の答えを、$arrayQuestionに問題を格納する
        for ($i = 0; $i < NUMBERQUESTION; $i++) {
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
選択したのは<?php echo ONEDIGIT ?>-<?php echo RANDDIGIT ?>までの問題です。<br>
全部で5問出題します。
<p>
    <form action ="calc3.php" method ="post">

    <?php for ($index = 0; $index < NUMBERQUESTION; $index++) : ?>

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