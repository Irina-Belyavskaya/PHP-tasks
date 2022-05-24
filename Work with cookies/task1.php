<?php
    if (isset($_POST["colorBackground"])) {
        setcookie("colorBackground",$_POST["colorBackground"],0,"","",true);
    }

    if (isset($_POST['colorFont'])) {
        setcookie('colorFont',$_POST['colorFont'],0,"","",true);
    }

    if (isset($_POST['colorHead'])) {
        setcookie('colorHead',$_POST['colorHead'],0,"","",true);
    }

    if (isset($_POST['sizeFont'])) {
        setcookie('sizeFont',$_POST['sizeFont'],0,"","",true);
        header('Location: task1.php');
    }

    if (isset($_COOKIE["colorBackground"])) {
        $colorBackground = $_COOKIE["colorBackground"];
    }

    if (isset($_COOKIE['colorFont'])) {
        $colorFont = $_COOKIE['colorFont'];
    }

    if (isset($_COOKIE['colorHead'])) {
        $colorHead = $_COOKIE['colorHead'];
    }

    if (isset($_COOKIE['sizeFont'])) {
        $sizeFont = $_COOKIE['sizeFont'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose your color and font size</title>
    <style>
        body {
            background-color: <?php echo $colorBackground ?>;
            color: <?php echo $colorFont ?>;
            font-size: 25px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        .header {
            background-color: <?php echo $colorHead ?>;
            font-size: <?php echo $sizeFont ?>px;
        }
    </style>
</head>
<body>
    <div class="header">
       <h1>Header</h1>
    </div>
    <form action="task1.php" method="POST">
        <label>Color background:
            <input type="color" name="colorBackground" value="<?php if (isset($_COOKIE["colorBackground"])) {
                echo $_COOKIE["colorBackground"];
            } else {
                echo "#ffffff";
            }  ?>">
        </label>
        <label>Color head:
            <input type="color" name="colorHead" value="<?php if (isset($_COOKIE['colorHead'])) {
                echo $_COOKIE['colorHead'];
            } else {
                echo "#ffffff";
            }  ?>">
        </label>
        <label>Color font:
            <input type="color" name="colorFont" value="<?php if (isset($_COOKIE['colorFont'])) {
                echo $_COOKIE['colorFont'];
            } else {
                echo "#000000";
            }  ?>">
        </label>
        <label>Size font:
            <input type="range" name="sizeFont" min="5" max="100" value="<?php if (isset($_COOKIE['sizeFont'])) {
                echo $_COOKIE['sizeFont'];
            } else {
                echo "20";
            }  ?>" step="5">
        </label>
        <input type="submit">
    </form>
</body>
</html>