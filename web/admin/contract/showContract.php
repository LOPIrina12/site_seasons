<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

$db = new Db();

$contracts = array();
$db->setQuery("SELECT `c`.`id`,`c`.`num_contract`,`c`.`status`,`o`.`name_org`, `t`.`number_place`,`t`.`size_square`
               FROM `contract` AS `c`
               INNER JOIN `organization` AS `o` ON `o`.`id`=`c`.`id_org`
               INNER JOIN `tradingPlace` AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`");
if ($db->getNumRows()){
    $contracts = $db->getObject();
}

$db->close();

file_include('/layers/headerAdmin.php', 'Договора');
?>

<div class="container">
    <h1>Договора</h1>
    <div class="info">
        <a href="<?=url('/web/admin/contract/addContract.php');?>"class="link-info _contract">Добавить</a>
    </div>
    <div class="content">
        <?php if ($contracts) :?>   
            <table class="table-app">
                <thead>
                    <tr>
                        <th class="table-th-app">Помещение</th>
                        <th class="table-th-app">Площадь, м2</th>
                        <th class="table-th-app">Договор</th>
                        <th class="table-th-app">Статус</th>
                        <th class="table-th-app">Арендатор</th>
                        <th class="table-th-app">Действия</th>   
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contracts as $contract) :?>
                        <tr>
                            <td class="table-td-app"><?=$contract->number_place; ?> </td>
                            <td class="table-td-app"><?=$contract->size_square; ?> </td>
                            <td class="table-td-app"><?=$contract->num_contract; ?></td>
                            <?php if ($contract->status === "1") :?>
                            <td class="table-td-app">Действующий</td>
                            <?php else :?>
                            <td class="table-td-app">Не действующий</td>
                            <?php endif ;?>
                            <td class="table-td-app"><?=$contract->name_org; ?></td>
                            <td>
                                <div class="table-app-btn-group">
                                    <a href="<?=url('/web/admin/contract/infoContract.php?id=' . $contract->id );?>" 
                                        title="Просмотреть" 
                                        class="table-app-btn _eye"><i class="fa fa-eye"></i></a>

                                    <a href="<?=url('/web/admin/contract/editContract.php?id='. $contract->id)?>"
                                        title="Редактировать" 
                                        class="table-app-btn _edit"><i  class="fa fa-edit"></i></a> 

                                    <a href="<?=url('/web/admin/contract/delContract.php?id='. $contract->id);?>"
                                        title="Удалить" 
                                        class="table-app-btn _trash"> <i class="fa fa-trash"></i></a>
                                    
                                </div>
                            </td>   
                        </tr>
                    <?php endforeach ;?>
                </tbody>  
            </table>
        <?php else:?>  
            <p>Договора не найдены.</p>  
        <?php endif ;?>
    </div>
<?php  file_include('/layers/footerAdmin.php'); ?>