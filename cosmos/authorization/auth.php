<?php
    session_start();
    if (empty($_SESSION['user']))
    {
        header("Location: ../../");
    }
    else if (isset($_POST['logout']))
    {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: ../../");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,300i,400,700&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Панель управления</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div>
        <?php echo "Добро пожаловать, ".$_SESSION['user'][1]; ?>
        <a href="../authorization.php" name="logout">Выйти</a>
    </div>
</body>
</html>
