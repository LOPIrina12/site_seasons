<? include '../../library/core.php';    
  file_include('/library/Db.php');  
 
  
  $login = '';
  $error = '';
  if ($_POST) {
      $db = new Db();
      $login = $_POST['login'];
      $password = $_POST['password'];
      $db->setQuery("SELECT `id`, `login`, `fio`, `role`  FROM `users` WHERE `login` = '$login' AND
      `password` = '$password' LIMIT 1 ");
      if ($db->getNumRows()) {
          $user = $db->getObject(1);
          $_SESSION['id'] = $user->id;
            $_SESSION['login'] = $user->login;
            $_SESSION['fio'] = $user->fio;
            header('Location: ' . url('/web/admin'));// перенаправляем на домашнюю страницу
      } else {
          $error = 'Пользователь не найден. Возможно вы неправильно ввели логин/пароль';
      }
       $db->close();// закрываем соединение с базой
  } 
  
  
    file_include('/layers/header.php', 'Вход в приложение');
  
  
  
?>  

<div class="content">
    <div class="container">
        <div class="arenda">
        
            <h1>Вход в личный кабинет</h1>
            <!--Обработчик находится в этом же файле-->
            <form class="form" action="<?=url('/web/auth/login.php');?>" method="POST">
                <div class="form-row">
                        <div class="form-col-left">
                        <label for="login" class="label-required">Логин</label>
                        </div>
                        <div class="form-col-right">
                        <input value="<?=$login?>" type="text" name="login" placeholder="введите логин" required>
                        </div>
                        
                        <div class="form-col-left">
                        <label for="password" class="label-required">Пароль</label>
                        </div>
                        <div class="form-col-right">
                        <input type="password" name="password" placeholder="введите пароль" required>
                        </div>            
                </div>
                <div class="div-button-submit" >

                <input type="submit" class="button-submit" name="submit" value="войти">
                
                </div>
               
                <?php if($error): ?><!--Если есть ошибки, то выводим-->
                    <p style="color: #DD0000"><?= $error; ?></p>
                <?php endif; ?>
            </form>
        </div> 
    </div>    
</div>



<?php file_include('/layers/footer.php'); ?>
