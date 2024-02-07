<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>laba 1</title>
</head>

<body>
    <header>
        <div class="header__wrapper">
            <img src="img/Logo_Polytech_rus_main.jpg" alt="Moscow Polytech logo" class="header__image">
            <h1 class="header__headline">Hello, World!</h1>
        </div>
    </header>

    <main>
        <div class="main__wrapper">
            <?php
                $hello = '<p class="main__text">Приветствую! </p>';
                $homeWork = '<p class="main__text">Домашнее задание №1</p>';
                echo $greeting;
                echo $homeWork;
            ?>
        </div>
    </main>

    <footer>
        <div class="footer__wrapper">
            <p class="footer__paragraf">Кашкин Владислав Игоревич</p>
        </div>
    </footer>
</body>
</html>