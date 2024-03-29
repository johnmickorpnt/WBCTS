<!DOCTYPE html>
<html>

<head>
    <title><?= $title?></title>
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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

    <div class="container">
        <?= isset($content) ? $content : "" ?>
    </div>
</body>

</html>