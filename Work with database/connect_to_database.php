<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task3</title>
    <style>
        table, tr, td {
            border: 2px solid black;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<?php
    $link = mysqli_connect('localhost','root','28103123','Shop');

    if (mysqli_connect_errno()) {
        echo 'Произошла ошибка при подключении с кодом '.mysqli_connect_errno().' : '.mysqli_connect_error();
        exit();
    }

    $sql = "SELECT * FROM `Users information`;";
    $result = mysqli_query($link,$sql);
    $userInfo = mysqli_fetch_all($result);

    $sql = "SELECT * FROM `Users products`;";
    $result = mysqli_query($link,$sql);
    $userProducts = mysqli_fetch_all($result);
    ?>
    <table cellpadding="5px">
        <?php foreach ($userInfo as $record) { ?>
            <tr>
                <?php foreach ($record as $block) {?>
                    <td>
                        <?php
                        echo $block;?>
                    </td>
                <?php }?>
            </tr>
        <?php } ?>
    </table>
    <br>
    <table cellpadding="5px">
        <?php foreach ($userProducts as $record) { ?>
            <tr>
                <?php foreach ($record as $block) {?>
                    <td>
                        <?php
                        echo $block;?>
                    </td>
                <?php }?>
            </tr>
        <?php } ?>
    </table>
</body>
</html>