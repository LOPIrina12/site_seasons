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
    <!--<script type="text/javascript" src="/asserts/js/jquery/jquery-3.4.1.min.js"> </script>-->
   <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
   <!-- <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>
    <script src="/assets/js/ajax.js"></script>-->
</head>
<body class="body-admin">
    <header class="header-admin">
        <div class="container">
            <div class="header-admin-inner">
                    <a href="<?=url('/');?>" class="header-admin-logo">SEASONS</a>
                    <div class="header-admin-nav">
                        <a href="<?=url('');?>">Организации</a>
                        <a href="<?=url('');?>">Торговые места</a>
                        <a href="<?=url('/web/admin/');?>">Заявки</a>
                        <?php if($_SESSION['role'] == 'admin') :?>
                        <a href="<?=url('/web/auth/registry.php');?>">Админ</a>
                        <?php endif;?>
                    </div>
                <div class="header-admin-fio"><?= $_SESSION['fio'] ?></div>
                <a href="<?=url('/web/auth/logout.php');?>" class="header-admin-logout">Выход</a>
            </div>
        </div>
    </header>
        <section id="content" class="content-admin">