<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "Blotter"; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fbc9e418a7.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("components/navbar.php") ?>

    <main <?= isset($containerStyles) ? "style='{$containerStyles}'" : "" ?>>
        <?= $content ? $content : "" ?>
    </main>
</body>

</html>