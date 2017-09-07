<?php

require('functionAndVarForFile.php');
require('redirectURL.php');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>編集</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="addTaskTitle"><h3>編集画面</h3></div>
    <form method="post" action="">
        <div class="form-group">
            <label for="taskId">タスクの番号を入力してください。</label>
            <input type="taskId" class="form-control" id="taskId" placeholder="タスクの番号" name="taskId">
        </div>
        <div class="form-group">
             <label for="addTaskName">タスク名</label>
             <input type="taskName" class="form-control" id="taskName" placeholder="タスク名" name="taskName">
         </div>
         <div class="form-group">
             <label for="daySet">期限 or 日程</label>
             <input type="date" class="form-control" id="daySet" placeholder="日付" name="daySet">
         </div>
         <button type="submit" class="btn btn-primary btn-lg">編集</button>
     </form>

     <?php
     if (isset($_POST['taskId'])) {
         $taskId = mb_convert_kana($_POST['taskId'], "n", "utf-8");
        $jsonDecodeArray = json_decode(readInputFile($filename));
        if (intval($taskId - 1) < 0 || sizeof($jsonDecodeArray) < intval($taskId - 1)) {
            echo 'タスクの番号が存在しません。';
            header("Location: {$url}");
            exit;
        }
        if (isset($_POST['taskName']) && isset($_POST['daySet'])) {
            fileDelete($filename);

            $jsonEditArray = array();
            foreach ($jsonDecodeArray as $jsonDecodeObj) {
                $jsonDecodeContent = (array)$jsonDecodeObj;
                if($jsonDecodeContent['id'] == $taskId - 1) {
                    $jsonEditArray [] =[
                        "id"       => $jsonDecodeContent['id'],
                        "taskName" => $_POST['taskName'],
                        "day"      => $_POST['daySet'],
                        "status"   => '0'
                    ];
                } else {
                    $jsonEditArray [] = [
                        "id"       => $jsonDecodeContent['id'],
                        "taskName" => $jsonDecodeContent['taskName'],
                        "day"      => $jsonDecodeContent['day'],
                        "status"   => $jsonDecodeContent['status']
                    ];
                }
            }
            $jsonEncode = json_encode($jsonEditArray);
            writeDateInFile($jsonEncode, $filename);
            header("Location: {$url}");
            exit;
        }
    }
     ?>
     <br>
     <a href="index.php" class="btn btn-info">タスクリストに戻る</a></div>

</body>

</html>
