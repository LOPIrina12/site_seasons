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
    <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link  rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="body-admin">
    <header class="header-admin">
        <div class="container">
            <div class="header-admin-inner">
                    <a href="<?=url('/');?>" class="header-admin-logo">SEASONS</a>
                    <div class="header-admin-nav">
                        <a href="<?=url('/web/admin/org/showOrg.php');?>">Организации</a>
                        <a href="<?=url('/web/admin/tradingPlace/showTrPlace.php');?>">Торговые места</a>
                        <a href="<?=url('/web/admin/');?>">Заявки</a>
                        <a href="<?=url('/web/admin/contract/showContract.php
                        ');?>">Договора</a>
                        <?php if($_SESSION['role'] == 'admin') :?>
                        <a href="<?=url('/web/auth/registry.php');?>">Регистрация</a>
                        <a href="<?=url('/web/admin/report/placeReport.php');?>">Отчёт</a>
                        <!-- <div class="custom-dropdown">
                            <div class="anchor" data-dropdown-anchor>Open</div>
                            <div class="custom-dropdown-menu">
                                <div class="custom-dropdown-menu-inner">
                                    <a href="#">11</a>
                                    <a href="#">11</a>
                                    <a href="#">11</a>
                                </div> 
                            </div>
                        </div> -->
                        <!-- <a href="<?=url('/web/admin/dashboard.php');?>">Отчёты </a>
                            <ul class="submenu">
                                <li><a href="<?=url('/web/admin/report/appReport.php');?>">Торговые места</a></li>
                            </ul> -->

                        <?php endif;?>
                    </div>
                <div class="header-admin-fio"><?= $_SESSION['fio'] ?></div>
                <a href="<?=url('/web/auth/logout.php');?>" class="header-admin-logout">Выход</a>
            </div>
        </div>
    </header>
        <section id="content" class="content-admin">