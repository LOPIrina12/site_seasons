<?php

    include '../../library/core.php';
    file_include('/library/Db.php');
    file_include('/layers/header.php', 'Вход в приложение');

?>

<div class="container-admin">
    <div class="cont-admin-left">

                <div>Учёт заявок+</div>
              
                <div><?= $_SESSION['fio'] ?></div>
                
                <div class="nav-admin">
                 <a href="<?=url('');?>">Организации</a>
                 <a href="<?=url('');?>">Торговые места</a>
                 <a href="<?=url('/web/admin/');?>">Заявки</a>
                 <a href="<?=url('/');?>">Сайт</a>
                 <a href="<?=url('');?>">Админ</a>
                </div>
 
    </div>
    
    <div  class="cont-admin-right">
        <div class="admin-info">
            <span class="soft"> AHEKA SOFT </span>
            <span>Добро пожаловать в программу!</span>
            <span>Используйте меню для перехода в нужный раздел.</span>
        </div>
    </div>

</div>

<?php file_include('/layers/footer.php'); ?>