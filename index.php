<?php
require('functionAndVarForFile.php');

$jsonDecodeArray = json_decode(readInputFile($filename));

if (isset($_POST['statusChange'])) {

    for ($i=0; $i <= sizeof($jsonDecodeArray); $i++) {
        if (isset($_POST[$i])) {
            if ($jsonDecodeArray[$i]->status === '1'){
                $jsonDecodeArray[$i]->status = '0';
            } elseif ($jsonDecodeArray[$i]->status == '0') {
                $jsonDecodeArray[$i]->status = '1';
            }

            fileDelete($filename);
            $jsonEncode = json_encode($jsonDecodeArray);
            writeDateInFile($jsonEncode, $filename);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>タスク管理</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <h1>タスクリスト</h1>
    <a href="addTask.php" class="btn btn-primary">追加する</a></div>
    <a href="edit.php" class="btn btn-primary">編集する</a></div>
    <a href="deleteContent.php" class="btn btn-primary">削除する</a></div>
    <div class="container">
        <table class="table table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>タスク名</th>
                    <th>期限 or 日程</th>
                    <th>完了 or 未完了</th>
                </tr>
            </thead>
            <tbody>

                    <?php
                    foreach ((array)$jsonDecodeArray as $jsonDecodeObj) {
                        $jsonDecodeContent = (array)$jsonDecodeObj;
                    ?>

                    <tr>
                    <th scope="row"><?php echo $jsonDecodeContent['id'] + 1; ?></th>
                    <td><?php echo $jsonDecodeContent['taskName']; ?></td>
                    <td><?php echo $jsonDecodeContent['day']; ?></td>

                    <form action="index.php" method="post">
                    <input type="hidden" name="buttonCount" value="<?php echo $jsonDecodeContent['id']?>">

                    <?php
                        if ($jsonDecodeContent['status'] === '1') {
                     ?>
                     <input type="hidden" name="statusChange">
                     <td><button class="btn btn-success" type="submit" name="<?php echo $jsonDecodeContent['id'] ?>">完了</button></td>

                    <?php
                        } else {
                    ?>
                    <input type="hidden" name="statusChange">
                    <td><button class="btn btn-danger" type="submit" name="<?php echo $jsonDecodeContent['id'] ?>">未完了</button></td>

                    <?php
                        }
                    }
                    ?>
                    </form>

                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
