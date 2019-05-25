<?php
   
    include '../../library/core.php';
    file_include('/library/Db.php');
    access(['admin']);
    
    $db = new Db();
    /*$applications='`date_app` DESC';*/
    $db->setQuery('SELECT `application`.`num_app`, `application`.`date_app`,`organization`.`name_org`, 
    `organization`.`fio`, `organization`.`phone`,`tradingPlace`.`number_place` 
    FROM `application` 
    INNER JOIN `organization` ON `application`.`id_org` = `organization`.`id` 
    INNER JOIN `tradingPlace` ON `application`.`id_tr_place` = `tradingPlace`.`id_tradingPlace` 
    ORDER BY `num_app` DESC');
   
    $applications = array();
    if ($db->getNumRows()) {
        $applications=$db->getObject();
    }
    $db->close();
    hgghghhhggjhgjhgjh
    
    file_include('/layers/header.php', 'Домашняя страница пользователя');
?>
<!--Начало HTML кода-->
<div class="container"><!--div контейнер для вывода контента сайта-->
    <!--Так как наличие сессии контролирует функция access(),
        то здесь мы можем выводить ее содержимое-->
    <!--<p>Добро пожаловать, <?= $_SESSION['fio'] ?> !</p>-->
    
    <h1>Заявка на аренду</h1>
    <?php if($applications):?>
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
        <?php foreach ($applications as $application):?>
         <tr>
            <td><?=$application->num_app; ?> </td>
            <td><?=$application->date_app; ?> </td>
            <td><?=$application->name_org; ?></td>
            <td><?=$application->number_place; ?></td>
            <td><?=$application->fio; ?></td>
            <td><?=$application->phone; ?></td>   
            <td>
            <button class="but-detailed">Подробнее</button>
            </td>   
        </tr>
     <?php endforeach; ?>   
    </table>
    <?php else: ?><!--Если заявок нет-->
        <p>Заявки не найдены</p>
	<?php endif; ?>
    
    
    
</div><!--Закрываем содержимое блока контент-->
<!--Завершение HTML кода-->
<!--Подключаем подвал сайта. Здесь будет идти код из файла /layers/footer.php-->
<?php file_include('/layers/footer.php'); ?>


