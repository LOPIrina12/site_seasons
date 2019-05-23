<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>seasons</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" 
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" 
        crossorigin="anonymous">
    <link  rel="stylesheet" href="/assets/css/normalize.css">
    <link  rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
        <header id="header" 
            class="header" 
            style="background-image: url('http://elgibborsms.com/blog/wp-content/uploads/2018/01/how-independent-retailers-can-thrive-in-a-volatile-market.jpg')">
            <div class="container">
            <!-- div навигация на сайте -->
                <div class="header-container">
                    <a href="<?=url('/');?>" class="logo">SEASONS</a>
                    <div class="nav">
                        <a href="<?=url('/web/general-info/general-information.php');?>">О центре</a>
                        <a href="<?=url('/web/toBuyers/buyers.php');?>">Покупателям</a>
                        <a href="<?=url('/web/toTenants/tenants.php');?>">Арендаторам</a>
                        <a href="<?=url('/contacts.php'); ?>">Контакты</a>
                    </div>
                    <div id="button-application">
                        <a href="<?=url('/web/tradingPlace/trPlace.php');?>" class="but">Свободные помещения</a>
                    </div>
                    
                    <div class="nav"><!--Div если пользователь  авторизован -->
                        <?php if ($_SESSION && $_SESSION['login']):?>
                        <a href="<?=url('/web/admin'); ?>">
                         <?= $_SESSION['fio'] ?><!--Фио авториз пользователя-->
                        </a>
                        <?php if ($_SESSION['role'] == 'admin') :?>
                        <a href="<?=url('/web/auth/registry.php'); ?>">Добавить пользователя</a>
                        <?php endif;?>
                         <a href="<?=url('/web/auth/logout.php'); ?>">Выйти</a>
                        <?php else:?><!--Для не авторизованных пользователей-->
                        <a href="<?=url('/web/auth/login.php'); ?>">Личный кабинет</a>
                        <?php endif;?>
                         
                    
                    </div>
                    
                </div>
            </div>
        </header>
        <section id="content" class="content">