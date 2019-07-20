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
            $_SESSION['role'] = $user->role;
            header('Location: ' . url('/web/admin/dashboard.php'));// перенаправляем на домашнюю страницу
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
            <h1>Вход в приложение <br>
            «Аренда недвижимого имущества» </h1>
            <form class="form-entry" action="<?=url('/web/auth/login.php');?>" method="POST">

                <div class="form-entry-errors">
                    <?php if($error): ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php endif; ?>
                </div>
  
                <div class="form-entry-row">
                    <div class="form-entry-field">
                        <label for="login">Логин</label>
                        <input value="<?=$login?>" type="text" name="login" placeholder="введите логин" required>
                    </div>           
                </div>

                <div class="form-entry-row">
                    <div class="form-entry-field">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" placeholder="введите пароль" required>
                    </div>
                </div>

                <div class="form-entry-submit" >
                    <button type="submit" name="submit" class="button button-secondary">Войти</button>
                </div>
               
               
            </form>
        </div> 
    </div>    
</div>



<?php file_include('/layers/footer.php'); ?>
