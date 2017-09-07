<?php

require('functionAndVarForFile.php');
require('redirectURL.php');

$jsonDecodeArray = json_decode(file_get_contents($filename));

if (isset($_POST['taskName']) && isset($_POST['daySet'])) {

    $jsonEditArray = array();
    foreach ($jsonDecodeArray as $jsonDecodeContent) {
        if($jsonDecodeContent->id == $_GET['taskId']) {
            $jsonEditArray [] =[
                "id"       => $jsonDecodeContent->id,
                "taskName" => $_POST['taskName'],
                "day"      => $_POST['daySet'],
                "status"   => '0'
            ];
        } else {
            $jsonEditArray [] = [
                "id"       => $jsonDecodeContent->id,
                "taskName" => $jsonDecodeContent->taskName,
                "day"      => $jsonDecodeContent->day,
                "status"   => $jsonDecodeContent->status
            ];
        }
    }

    writeDateInFile($jsonEditArray, $filename);
    header("Location: {$url}");
    exit;
}
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
             <label for="addTaskName">タスク名</label>
             <input type="taskName" class="form-control" id="taskName" placeholder="<?php echo $jsonDecodeArray[$_GET['taskId']]->taskName?>" name="taskName">
         </div>
         <div class="form-group">
             <label for="daySet">期限 or 日程</label>
             <input type="date" class="form-control" id="daySet" placeholder="<?php echo $jsonDecodeArray[$_GET['taskId']]->day?>" name="daySet">
         </div>
         <button type="submit" class="btn btn-primary btn-lg">編集</button>
     </form>

     <br>
     <a href="index.php" class="btn btn-info">タスクリストに戻る</a></div>

</body>

</html>
