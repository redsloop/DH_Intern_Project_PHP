<?php
require('functionAndVarForFile.php');
require('classForFile.php');
require('redirectURL.php');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>タスクを追加</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="addTaskTitle"><h3>追加画面</h3></div>
    <form method="post" action="">
        <div class="form-group">
            <label for="addTaskName">タスク名</label>
            <input type="taskName" class="form-control" id="taskName" placeholder="タスク名" name="taskName">
        </div>
        <div class="form-group">
            <label for="daySet">期限 or 日程</label>
            <input type="date" class="form-control" id="daySet" placeholder="limite or date" name="daySet">
        </div>
        <button type="submit" class="btn btn-primary btn-lg">追加</button>
    </form>
    <?php
    if (isset($_POST['taskName']) && isset($_POST['daySet'])) {

        $list = new toDoList($_POST['taskName'], $_POST['daySet']);

        $jsonDecodeArray = json_decode(readInputFile($filename));
        fileDelete($filename);
        $jsonDecodeArray [] = [
            "id"       => sizeof($jsonDecodeArray),
            "taskName" => $list->getTaskName(),
            "day"      => $list->getDaySet(),
            "status"   => $list->getStatus()
        ];
        $jsonEncode = json_encode($jsonDecodeArray);

        $list->writeDateInFile($jsonEncode, $filename);
        header("Location: {$url}");
        exit;
    }

    ?>
    <br>
    <a href="index.php" class="btn btn-info">タスクリストに戻る</a></div>
</body>

</html>
