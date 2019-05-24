<?php
   
    include '../../library/core.php';
    file_include('/library/Db.php');
    access(['admin']);
    
    $db = new Db();
    $db->setQuery();
    
    
    
    file_include('/layers/header.php', 'Домашняя страница пользователя');
?>
<!--Начало HTML кода-->
<div class="container"><!--div контейнер для вывода контента сайта-->
    <!--Так как наличие сессии контролирует функция access(),
        то здесь мы можем выводить ее содержимое-->
    <!--<p>Добро пожаловать, <?= $_SESSION['fio'] ?> !</p>-->
    
    <h1>Заявка на аренду</h1>
    <table>
        <tr>
            <th>Номер заяки</th>
            <th>Дата заяки</th>
            <th>Организация</th>
            <th>Номер торгового места</th>
            <th>Контактное лицо</th>
            <th>Телефон</th>   
            <th>Подробнее</th>   
        </tr>
         <tr>
            <td>Номер заяки</td>
            <td>Дата заяки</td>
            <td>Организация</td>
            <td>Номер торгового места</td>
            <td>Контактное лицо</td>
            <td>Телефон</td>   
            <td>
            <button class="but-detailed">Подробнее</button>
            </td>   
        </tr>
        
    </table>
   
    
    
    
</div><!--Закрываем содержимое блока контент-->
<!--Завершение HTML кода-->
<!--Подключаем подвал сайта. Здесь будет идти код из файла /layers/footer.php-->
<?php file_include('/layers/footer.php'); ?>


