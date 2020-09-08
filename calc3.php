<!-- 計算機　問題の答えと入力された解答の答え合わせをする画面 -->
<?php 
	//前画面からPOSTで値が飛んできていない場合は何も表示しない
    if (!empty($_POST["arrayInputAnswer"])) :
    	
    	//入力された問題の解答を格納する配列
        $arrayInputAnswer = $_POST['arrayInputAnswer'];
        //問題を格納する配列
        $arrayQuestion = unserialize($_POST['arrayQuestion']);
        //問題の答えを格納する配列
        $arrayAnswer = unserialize($_POST['arrayAnswer']);
        
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>研修計算機</title>
</head>
<body>
<p>練習問題結果</p>
<?php for ($n = 0; $n < 5; $n++) : ?>
    <?php echo $n + 1 ?>問目  <?php echo $arrayQuestion[$n] ?>  <?php echo $arrayInputAnswer[$n] ?>
    <?php if ($arrayInputAnswer[$n] == $arrayAnswer[$n]) : ?>
    ...正解<br>
    <?php else : ?>
    ...不正解。答えは<?php echo $arrayAnswer[$n] ?>。<br>
    <?php endif; ?>

<?php endfor; ?>

<?php endif; ?>
</body>
</html>
