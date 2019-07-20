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
<body>
        <header id="header" 
            class="header">
            <div class="container">
            <!-- div навигация на сайте -->
                <div class="header-container">

                    <a href="<?=url('/');?>" class="logo">SEASONS</a>
                        <div class="nav">
                            <a href="<?=url('/web/general-info/general-information.php');?>">О центре</a>
                          <!--  <a href="<?=url('/web/toBuyers/buyers.php');?>">Покупателям</a>-->
                            <a href="<?=url('/web/toTenants/tenants.php');?>">Арендаторам</a>
                            <a href="<?=url('/contacts.php'); ?>">Контакты</a>
                        </div>
                    <div id="button-application">
                        <a href="<?=url('/web/tradingPlace/trPlace.php');?>" class="header-button">Свободные помещения</a>
                    </div>
  
                </div>
            </div>
        </header>
    
        <section id="content" class="content">