<?php
    use PHPMailer\PHPMailer\PHPMailer;

    include './PHPMailer/Exception.php';
    include './PHPMailer/PHPMailer.php';
    include './PHPMailer/SMTP.php';

    $isError = false;
    $isSet = false;
    $errors = Array();
    $i = 0;
    if (isset($_POST['email'])) {
        $isSet = true;
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $isError = true;
            $errors[$i] = 'Email не корректный.';
            $i++;
        }
    }
    if (isset($_POST['phone'])) {
        $isSet = true;
        $checkString = trim($_POST['phone'],'+');
        if (!filter_var($checkString, FILTER_VALIDATE_INT)) {
            $isError = true;
            $errors[$i] = 'Номер телефона не корректный.';
            $i++;
        }
    }
    if ($isError) {
        foreach ($errors as $error) {
            echo '<p>'.$error.'</p>';
        }
    } else if ($isSet) {
        // PHPMailer
        $mail = new PHPMailer;
        $mail->addReplyTo('ir200210b@mail.ru', 'Irina Belyavskaya');
        $mail->CharSet = 'UTF-8';

        // Настройки SMTP
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;

        // Авторизация SMTP
        $mail->Host = 'ssl://smtp.mail.ru';
        $mail->Port = 465;
        $mail->Username = 'ir200210b@mail.ru';
        $mail->Password = 'ztYwNaAhFyxAHwF1g7pe';

        $mail->setFrom('ir200210b@mail.ru', 'Irina Belyavskaya');
        $mail->addAddress($_POST['email'], $_POST['name']);
        $mail->Subject = $_POST['theme'];
        $mail->Body = $_POST['message'];

        if ($mail->send()) {
            echo '<p style="color: green; font-weight: bold;">'.'Your mail was sent!'.'</p>';
        } else {
            echo '<p style="color: red; font-weight: bold;">'.'Error!'. $mail->ErrorInfo.'</p>';
        }

        $mail->setFrom('ir200210b@mail.ru', 'Irina');
        $mail->addAddress('ir200210b@mail.ru', 'Irina');
        $mail->Subject = 'Reply Letter';
        $mail->Body = 'Thank you for sending the email, '.$_POST['name'].' will reply to you soon.';

        if ($mail->send()) {
            echo '<p style="color: green; font-weight: bold;">'.'Reply Letter was sent!'.'</p>';
        } else {
            echo '<p style="color: red; font-weight: bold;">'.'Error in sending Reply Letter!'. $mail->ErrorInfo.'</p>';
        }
//        $to= $_POST['email'];
//        $topic = base64_encode($_POST['theme']);
//        $message = wordwrap($_POST['message'], 70);
//        $headers = array(
//            'Content-type' => 'text/plain; charset=utf-8;',
//            'From' => 'Irina',
//            'Reply-To' => $_POST['email'],
//            'Return-Path' => 'ir200210b@mail.ru'
//        );
//
//        if (mail($to, $topic, $message, $headers))
//        echo '<p style="color: green; font-weight: bold;">'.'Your mail was sent!'.'</p>';
//        else
//            echo '<p style="color: red; font-weight: bold;">'.'Error!'.'</p>';
   }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Sending message</title>
</head>
<body>
    <h1>Send your message!</h1>
    <form action="task1_from_manual.php" method="post">
        <label for="name">Receiver Name</label>
        <input type="text" name="name" id="name" placeholder="Name" value="<?php
            if (isset($_POST['name']) && $isError) echo $_POST['name'];
        ?>" required>
        <label for="phone">Receiver phone number</label>
        <input type="tel" name="phone" id="phone" placeholder="Phone number" value="<?php
            if (isset($_POST['phone']) && $isError) echo $_POST['phone'];
        ?>" required>
        <label for="email">Receiver Email</label>
        <input type="email" name="email" id="email" placeholder="Email" value="<?php
            if (isset($_POST['email']) && $isError) echo $_POST['email'];
        ?>" required>
        <label for="theme">Message theme</label>
        <input type="text" name="theme" id="theme" placeholder="Topic of message" value="<?php
            if (isset($_POST['theme']) && $isError) echo $_POST['theme'];
        ?>" required>
        <label for="message">Your message</label>
        <textarea name="message" id="message" rows="7" cols="26" placeholder="Message" required><?php
            if (isset($_POST['message']) && $isError) echo $_POST['message'];
        ?></textarea>
        <input type="submit" value="Send" class="btn">
    </form>
</body>
</html>
