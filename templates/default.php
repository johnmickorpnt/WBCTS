<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "Blotter"; ?></title>
    <link rel="stylesheet" href="<?= asset("css/footerstyle.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/headerstyle.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>">
    <script src="https://kit.fontawesome.com/fbc9e418a7.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <?= component("header.php") ?>
    <main class="main-container" <?= isset($containerStyles) ? "style='{$containerStyles}'" : "" ?>>
        <?= $content ? $content : "" ?>
    </main>
    <?= component("footer.php") ?>
</body>

</html>