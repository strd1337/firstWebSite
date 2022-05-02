<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "", "users");
    if (mysqli_connect_errno()) echo mysqli_connect_error();

    if (isset($_POST['do_signup']))
    {
        $login = trim(htmlspecialchars($_POST['login']));
        $password = md5(trim(htmlspecialchars($_POST['password'])));
        $passwordSimple = $_POST['password'];
        $passwordSimple2 = $_POST['password_2'];
        $err;
        $query = mysqli_query($connection, "SELECT * FROM users WHERE login = '$login'");

        if(mysqli_num_rows($query) > 0)
        {
            $err = "Пользователь с таким логином уже существует в базе данных.";
        }
        else if(!preg_match("/^[a-zA-Z0-9]+$/", $login))
        {
            $err = "Логин может состоять только из букв английского алфавита и цифр.";
        }
        else if(strlen($login) < 3 or strlen($login) > 30)
        {
            $err = "Логин должен быть не меньше 3-х символов и не больше 30.";
        }
        else if ($passwordSimple != $passwordSimple2)
        {
            $err = "Вы неправильно ввели пароль повторно.";
        }
        else if (!isset($_POST['checkbox']))
        {
            $err = "Вы не согласились с соглашением.";
        }

        if(isset($err))
        {
            die($err);
        }
        else
        {
            mysqli_query($connection, "INSERT INTO users (login, password) VALUES ('$login', '$password')");
            header("Location: authorization.php");
            exit();
        }
    }
    else if (isset($_POST['do_auth']))
    {
        $login = trim(htmlspecialchars($_POST['login']));
        $password = md5(trim(htmlspecialchars($_POST['password'])));
        $query_auth = mysqli_query($connection, "SELECT * FROM users WHERE login = '$login' AND password = '$password'");
        if (mysqli_num_rows($query_auth) == 1) {
            $row_auth = mysqli_fetch_assoc($query_auth);
            $_SESSION['user'] = array($row_auth['id'], $row_auth['login'], $row_auth['password']);
            header("location: authorization/auth.php");
        } else
            die("Неверный логин или пароль!");
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,300i,400,700&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Авторизация</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="js/slick-1.8.1/slick/slick.css">
        <link rel="stylesheet" href="js/slick-1.8.1/slick/slick-theme.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/slick-1.8.1/slick/slick.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>
            wow = new WOW({
                boxClass: 'wow'
                , animateClass: 'animated'
                , offset: 0
                , mobile: true
                , live: true
            })
            wow.init();
        </script>
    </head>

    <body>

        <!-- header -->
        <header class="header">
            <div class="container">
                <div class="header__inner">
                    <div class="company">
                        <div class="company__avatar">
                            <a href="index.html" title="Космос"><img src="images/company_icon.png" alt="Космос" title="Космос"> </a>
                        </div>
                        <div class="company__content">
                            <div class="company__name">COSMOS</div>
                            <div class="company__prof">Управление предприятием</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- authorization -->
        <div class="enter">
            <div class="enter__contant">
                <div class="enter__forms">
                    <label class="tab tab__active" title="Авторизация">Авторизация</label>
                    <label class="tab" title="Регистрация">Регистрация</label>

                    <form class="tab__form tab__active" action="authorization.php" method="POST">
                        <input class="tab__form-input" name="login" type="text" placeholder="Введите логин" required>
                        <input class="tab__form-input" name="password" type="password" placeholder="Введите пароль" required>
                        <button class="tab__form-button" name="do_auth">Войти</button>
                        <ul class="enter__social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-vk"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                        <a class="enter__forget" href="#">Я забыл свой E-mail или пароль</a>
                    </form>

                    <form class="tab__form" action="authorization.php" method="POST">
                        <input class="tab__form-input" name="login" type="text" placeholder="Введите логин" required>
                        <input class="tab__form-input" name="password" type="password" placeholder="Введите пароль" required>
                        <input class="tab__form-input" name="password_2" type="password" placeholder="Повторно введите пароль" required>
                        <button class="tab__form-button" name="do_signup">Регистрация</button>
                        <div class="recover">
                            <input type="checkbox" name="checkbox" id="ckbox">
                            <label class="recover__ckbox" for="ckbox">Ознакомлен(-а) и принимаю <a href="#">условия регистрации.</a></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer class="footer">
            <div class="footer__contant">
                <div class="container">
                    <div class="footer__inner">
                        <div class="footer__info">
                            <div class="footer__title">Lorem ipsum dolor sit amet</div>
                            <div class="footer__text">Consectetur adipiscing elit. Curabitur pretium consequat volutpat. Integer ultricies ligula eget arcu.</div>
                            <ul class="footer__list">
                                <li class="footer__list-link"><a href="tel:37378054251">+373 78 054 251</a></li>
                                <li class="footer__list-link"><a href="#">cosmos@gmail.ru</a></li>
                                <li class="footer__list-link"><a href="#">Bulevardul Constantin Negruzzi 2, Chișinău, Moldova</a></li>
                            </ul>
                        </div>
                        <div class="footer__map">
                            <iframe class="footer__map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3847.1050911835514!2d28.852341381351348!3d47.014439303632926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97c178ddb02d9%3A0xa83dcfdc7c3755dc!2z0JPQvtGB0YLQuNC90LjRhtCwICLQmtC-0YHQvNC-0YEi!5e0!3m2!1sru!2s!4v1648135894360!5m2!1sru!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__copy">
                <div class="container">
                    <div class="copy__text"> © «Космос» 2018. Все права защищены. </div>
                </div>
            </div>
        </footer>
    </body>

    </html>
