<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Download picture</title>
</head>
<body>
<h1>Download picture!</h1>
<form action="task1_from_document.php" method="post">
    <label for="url">Enter the URL</label>
    <input type="text" name="url" id="url" placeholder="URL" required>
    <label for="folder">Way to folder</label>
    <input type="text" name="folder" id="folder" value="/testFolder" placeholder="Folder" required>
    <input type="submit" value="Download" class="btn">
</form>
</body>
</html>
<?php
if (isset($_POST['url']) && isset($_POST['folder'])){
    $url = $_POST['url'];
    $path = $_POST['folder'];

    $html = file_get_contents($url);
    if (!$html)
        echo "Cannot read url";
    else {
        $external = true;
        preg_match_all('/<img.*?src=["\'](.*?)["\'].*?>/i', $html, $images, PREG_SET_ORDER);

        $url = parse_url($url);
        $path = rtrim($path, '/');

        foreach ($images as $image) {

            $format = strtolower(substr(strrchr($image[1], '.'), 1));
            if (in_array($format, array('jpg', 'jpeg', 'png', 'gif'))) {
                $img = parse_url($image[1]);

                if (is_file($path . $img['path'])) {
                    continue;
                }

                $path_img = $path . '/' . dirname($img['path']);
                if (!is_dir($path_img)) {
                    mkdir($path_img, 0777, true);
                }

                if (empty($img['host']) && !empty($img['path'])) {
                    copy($url['scheme'] . '://' . $url['host'] . $img['path'], $path . $img['path']);
                } elseif ($external || ($img['host'] == $url['host'])) {
                    copy($image[1], $path . $img['path']);
                }
            }
        }
    }
}


