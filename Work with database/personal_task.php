<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>
        Information about users
    </h2>
<?php
    if(isset($_POST['add']))
    {
        $link = mysqli_connect('localhost','root','28103123','Shop');
        if (mysqli_connect_errno()) {
            echo 'Произошла ошибка при подключении с кодом '.mysqli_connect_errno().' : '.mysqli_connect_error();
            exit();
        }
        $name = $_POST['name'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql = "INSERT INTO `Users information` (`id`, `name`, `login`, `password`) VALUES (NULL, '$name', '$login', '$password');";
        $result = mysqli_query($link, $sql);
        mysqli_close($link);
    }

    if (isset($_POST['delete']))
    {
        $link = mysqli_connect('localhost','root','28103123','Shop');
        if (mysqli_connect_errno()) {
            echo 'Произошла ошибка при подключении с кодом '.mysqli_connect_errno().' : '.mysqli_connect_error();
            exit();
        }
        if (isset($_POST['id']) && $_POST['id'] !== "") {
            $id = $_POST['id'];
            $sql = "DELETE FROM `Users information` WHERE `Users information`.`id` = '$id';";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                echo "Произошла ошибка при отправке запроса";
            }
        }
        if (isset($_POST['name']) && $_POST['name'] !== "") {
            $name= $_POST['name'];
            $sql = "DELETE FROM `Users information` WHERE `Users information`.`name` = '$name';";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                echo "Произошла ошибка при отправке запроса";
            }
        }
        if (isset($_POST['login']) && $_POST['login'] !== "") {
            $login = $_POST['login'];
            $sql = "DELETE FROM `Users information` WHERE `Users information`.`login` = '$login';";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                echo "Произошла ошибка при отправке запроса";
            }
        }
        mysqli_close($link);
    }

    if (isset($_POST['change']))
    {
        $link = mysqli_connect('localhost','root','28103123','Shop');
        if (mysqli_connect_errno()) {
            echo 'Произошла ошибка при подключении с кодом '.mysqli_connect_errno().' : '.mysqli_connect_error();
            exit();
        }
        $idNew = $_POST['id'];
        $nameNew = $_POST['name'];
        $loginNew = $_POST['login'];
        $passwordNew = $_POST['password'];

        $sql = "UPDATE `Users information` SET `name` = '$nameNew', `login` = '$loginNew', `password` = '$passwordNew' WHERE `Users information`.`id` = '$idNew';";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            echo "Произошла ошибка при отправке запроса";
        }
        mysqli_close($link);
    }
?>
<?php
    $link = mysqli_connect('localhost','root','28103123','Shop');
    if (mysqli_connect_errno()) {
        echo 'Произошла ошибка при подключении с кодом '.mysqli_connect_errno().' : '.mysqli_connect_error();
        exit();
    }
    $sql = "SELECT * FROM `Users information`;";
    $result = mysqli_query($link,$sql);
    if (!$result) {
        echo "Произошла ошибка при отправке запроса";
    }
    $userInfo = mysqli_fetch_all($result);
    mysqli_close($link);
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
    <h2>Add information about user</h2>
    <form action="personal_task.php" method="post" class="form">
        <label for="name">User name</label>
        <input type="text" id="name" placeholder="Name" name="name" maxlength="20" class="input" required>
        <label for="login">Login</label>
        <input type="text" id="login" placeholder="Login" name="login" maxlength="20" class="input" required>
        <label for="password">Password</label>
        <input type="text" id="password" placeholder="Password" name="password" maxlength="8" class="input" required>
        <input type="submit" name="add" value="Add" class="btn">
    </form>
    <h2>Delete information about user</h2>
    <form action="personal_task.php" method="post" class="form">
        <input type="submit" name="idButton" value="By ID" class="btn btn-choice">
        <input type="submit" name="nameButton" value="By Name" class="btn btn-choice">
        <input type="submit" name="loginButton" value="By Login" class="btn btn-choice">
        <?php if (isset ($_POST['idButton'])) { ?>
            <br><label for="id">User id</label>
            <input type="number" id="name" placeholder="ID" name="id" class="input" >
        <?php } ?>
        <?php if (isset ($_POST['nameButton'])) { ?>
            <br><label for="name">User name</label>
            <input type="text" id="name" placeholder="Name" name="name" maxlength="20" class="input" >
        <?php } ?>
        <?php if (isset ($_POST['loginButton'])) { ?>
            <br><label for="login">User login</label>
            <input type="text" id="name" placeholder="Login" name="login" maxlength="20" class="input" >
        <?php } ?>
        <br><input type="submit" name="delete" value="Delete" class="btn">
    </form>
    <h2>Change information about the user</h2>
    <form action="personal_task.php" method="post" class="form">
        <label for="id">User name</label>
        <input type="number" id="name" placeholder="ID" name="id" class="input" required>
        <label for="name">User name</label>
        <input type="text" id="name" placeholder="Name" name="name" maxlength="20" class="input" required>
        <label for="login">Login</label>
        <input type="text" id="login" placeholder="Login" name="login" maxlength="20" class="input" required>
        <label for="password">Password</label>
        <input type="text" id="password" placeholder="Password" name="password" maxlength="8" class="input" required>
        <input type="submit" name="change" value="Change" class="btn">
    </form>
</body>
</html>

