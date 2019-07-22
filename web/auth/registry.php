<?php
include '../../library/core.php';
file_include('/library/Db.php');

access (['admin']);

$login = '';
$role = '';
$fio = '';
$error_login = false;
$error_pass = false;
$error = false;
$db = new Db();
if ($_POST) {
    if ($_POST['login'] && $_POST['password'] &&
    $_POST['repeat_password'] &&
    $_POST['fio'] && $_POST['role']) {
        $login = $_POST['login'];
        $password = $_POST ['password'];
        $repeat_password=$_POST['repeat_password'];
        $fio = $_POST['fio'];
        $role = $_POST['role'];
        $db->setQuery("SELECT `id`, `login` FROM `users` 
                WHERE `login` = '$login' LIMIT 1");
                if ($db->getNumRows()) {
                    $error_login = "Пользователь уже существует!";
                }
                if ($password != $repeat_password) {
                    $error_pass = "Пароли не совпадают!";
                }
                if (!$error && !$error_login && !$error_pass) {
                    $db->setQuery ("INSERT INTO `users` (`login`, `password`,`fio`,`role`)
                                    VALUES ('$login','$password','$fio','$role')");
                    //$_SESSION['login'] = $login; 
                    //$_SESSION['password'] = $password;
                    //$_SESSION['fio'] =  $fio;
                    header('Location: ' . url('/web/admin/dashBoard.php'));       
                }
    }
    else {
        $error="Указаны не все поля!";
    }
}
$db->close();
file_include('/layers/headerAdmin.php', 'Регистрация');

?>

<div class="container">
    <h1>Регистрация нового пользователя</h1>
        <div class="table-app">
            <form class="form-registry" action="<?=url('/web/auth/registry.php');?>" method="POST">
                <div class="form-row">
                    <div class="form-col-left"></div>
                    <div class="form-col-right">
                        <p>Поля, отмеченные звездочкой, обязательны для заполнения.<p>
                     </div>
                </div>
                        
                <div class="form-row">
                    <div class="form-col-left">
                        <label for="login" class="label-required">Логин</label>
                    </div>
                    <div class="form-col-right">
                        <input type="text" name="login" placeholder="Введите логин" 
                        required value="<?=$login;?>">
                        <?php if($error_login ): ?>
                        <p><?=$error_login;?></p>
                        <?php endif ;?>
                    </div> 
                </div>  
                        
                <div class="form-row">
                    <div class="form-col-left">
                        <label for="password" class="label-required">Пароль</label>
                    </div>
                    <div class="form-col-right">
                        <input type="password" name="password" placeholder="Введите пароль" 
                        required value="<?=$password;?>">
                        <?php if ($error_pass) :?>
                        <p><?=$error_pass?></p>
                        <?php endif ;?>
                    </div> 
                </div>
                        
                <div class="form-row">
                    <div class="form-col-left">
                        <label for="repeat_password" class="label-required">Подтверждение пароля</label>
                    </div>
                    <div class="form-col-right">
                        <input type="password" name="repeat_password" placeholder="Подтвердите пароль" 
                        required
                        value="<?=$repeat_password?>">
                        <?php if ($error_pass):?>
                        <p><?=$error_pass?></p>
                        <?php endif;?>
                    </div> 
                </div>
                        
                <div class="form-row">
                    <div class="form-col-left">
                        <label for="fio" class="label-required">ФИО</label>
                    </div>
                    <div class="form-col-right">
                        <input type="text" name="fio" placeholder="Введите ФИО" 
                        required value="<?=$fio?>">
                    </div> 
                </div>  
                        
                <div class="form-row">
                    <div class="form-col-left">
                         <label for="role" class="label-required">Выберите роль</label>
                    </div>
                    <div class="form-col-right">
                        <select class="select"  name="role">
                             <option  value="user" <?= ($role == 'user') ? 'selected' : '';?> >Администратор ТЦ</option>
                             <option  value="user" <?= ($role == 'user') ? 'selected' : '';?> >Юрисконсульт</option>
                        </select>    
                    </div> 
                </div> 
                        
                <div class="div-button-submit button-group" >
                    <button type="submit" class="button button-info">Зарегистрировать</button> 
                    <button type="reset" class="button button-default">Очистить</button>
                </div>
            </form>
            <?php if($error): ?>
            <p style="width:100%; margin:0; color: #DD0000"><?= $error; ?></p>
            <?php endif; ?>
        </div>
</div>


<?php file_include('/layers/footerAdmin.php'); ?>