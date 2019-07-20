<?php
   
    include '../../library/core.php';
    file_include('/library/Db.php');
    access(['admin']);
    
    $db = new Db();
    $db->setQuery(
    'SELECT `application`.`id`, `application`.`num_app`, `application`.`date_app`,`organization`.`name_org`, 
    `organization`.`fio`, `organization`.`phone`,`application`.`processed`,`tradingPlace`.`number_place` ,`tradingPlace`.`rented`
    FROM `application` 
    INNER JOIN `organization` ON `application`.`id_org` = `organization`.`id` 
    INNER JOIN `tradingPlace` ON `application`.`id_tr_place` = `tradingPlace`.`id_tradingPlace` 
    ORDER BY `num_app` DESC');
   
    $applications = array();
    if ($db->getNumRows()) {
        $applications=$db->getObject();
    }

    $date_app = strtotime($applications->date_app);
    $date_appForView = date("d.m.y $date_app");
    $db->close();
    
    
    file_include('/layers/headerAdmin.php', 'Заявки');
?>

<div class="container">
    <h1>Заявки на аренду</h1>
    <div class="info">
        <a href="<?=url('/web/admin/app/addApp.php');?>"class="link-info _contract">Добавить</a>
    </div> 
    <div class="content">
        <?php if($applications):?>
        <table class="table-app">
            <thead>
                <tr>
                    <th class="table-th-app">Код</th>
                    <th class="table-th-app">Номер заяки</th>
                    <th class="table-th-app">Дата заяки</th>
                    <th class="table-th-app">Организация</th>
                    <th class="table-th-app">Tорговое места</th>
                    <th class="table-th-app">Контактное лицо</th>
                    <th class="table-th-app">Телефон</th>
                    <th class="table-th-app">Статус</th>    
                    <th class="table-th-app">Действия</th>   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $application):?>
                    <tr>
                        <td class="table-td-app"><?=$application->id; ?> </td>
                        <td class="table-td-app"><?=$application->num_app; ?> </td>
                        <td class="table-td-app"><?=$date_appForView; ?> </td>
                        <td class="table-td-app"><?=$application->name_org; ?></td>
                        <td class="table-td-app"><?=$application->number_place; ?></td>
                        <td class="table-td-app"><?=$application->fio; ?></td>
                        <td class="table-td-app"><?=$application->phone; ?></td> 
                        <? if ($application->processed === '1') :?>
                        <td class="table-td-app">Обработано</td> 
                        <?else :?>
                        <td class="table-td-app">Не обработано</td> 
                        <?endif ?>
                        <td>
                            <div class="table-app-btn-group">
                                <a href="<?=url('/web/admin/info.php?num_app=' . $application->num_app);?>" 
                                    title="Просмотреть" 
                                    class="table-app-btn _eye"><i class="fa fa-eye"></i></a>
                                <!-- <a href="<?=url('/web/admin/app/addApp.php')?>" 
                                    title="Добавить" 
                                   class="table-app-btn _plus"><i class="fa fa-plus"></i></a>-->
                                <a href="<?=url('/web/admin/app/editApp.php?num_app=' . $application->num_app)?>"
                                    title="Редактировать" 
                                    class="table-app-btn _edit"><i  class="fa fa-edit"></i></a>               
                                <a href="<?=url('/web/admin/app/delApp.php?num_app=' . $application->num_app);?>"
                                    title="Удалить" 
                                    class="table-app-btn _trash"> <i class="fa fa-trash"></i></a>
                                  
                            </div>
                        </td>   
                    </tr>
                <?php endforeach; ?> 
            </tbody>  
        </table>
        <?php else: ?><!--Если заявок нет-->
            <p>Заявки не найдены</p>
        <?php endif; ?>
    </div>
</div><!--Закрываем содержимое блока контент-->
<!--Завершение HTML кода-->
<!--Подключаем подвал сайта. Здесь будет идти код из файла /layers/footer.php-->
<?php file_include('/layers/footerAdmin.php'); ?>


