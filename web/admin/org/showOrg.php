<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);



$db = new Db();
$orgs = array ();
$db->setQuery ("SELECT * FROM `organization` /*ORDER BY `name_org`*/" );
if ($db->getNumRows ()) {
    $orgs = $db->getObject();
}
// echo '<pre>';
// var_dump ($orgs);
// echo '</pre>';
$db->setQuery ("SELECT COUNT(`id`) AS `count` FROM `organization`");
if ($db->getNumRows ()) {
    $count = $db->getObject(1);
}
$count_for_view=$count->count;

$db->close();


file_include('/layers/headerAdmin.php', 'Организации');
?>

<div class="container">
    <h1>Справочник: Организации</h1>
    <div class="info">
        <a href="<?=url('/web/admin/org/addOrg.php');?>"class="link-info _contract">Добавить</a>
        <!--<a href="<?=url('/web/admin/org/addContract.php');?>"class="link-info _contract">Договор</a>-->
    </div>
    

    <div class="content">
        <?php if($orgs):?>
            <table class="table-app">
                <thead>
                    <tr>
                        <th class="table-th-app">Код</th>
                        <th class="table-th-app">Организация</th>
                        <th class="table-th-app">УНП</th>
                        <th class="table-th-app">Адрес</th>
                        <th class="table-th-app">Телефон</th>
                        <th class="table-th-app">Контактное лицо</th>
                        <th class="table-th-app">Действия</th>   
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orgs as $org):?>
                        <tr>
                            <td class="table-td-app"><?=$org->id; ?> </td>
                            <td class="table-td-app"><?=$org->name_org; ?> </td>
                            <td class="table-td-app"><?=$org->ynp; ?></td>
                            <td class="table-td-app"><?=$org->adress; ?></td>
                            <td class="table-td-app"><?=$org->phone; ?></td>
                            <td class="table-td-app"><?=$org->fio; ?></td> 
                            <td>
                                <div class="table-app-btn-group">
                                    <a href="<?=url('/web/admin/org/infoOrg.php?id=' . $org->id);?>" 
                                        title="Просмотреть" 
                                        class="table-app-btn _eye"><i class="fa fa-eye"></i></a>

                                    <a href="<?=url('/web/admin/org/editOrg.php?id=' . $org->id)?>"
                                        title="Редактировать" 
                                        class="table-app-btn _edit"><i  class="fa fa-edit"></i></a> 

                                    <a href="<?=url('/web/admin/org/delOrg.php?id=' . $org->id);?>"
                                        title="Удалить" 
                                        class="table-app-btn _trash"> <i class="fa fa-trash"></i></a>
                                    
                                </div>
                            </td>   
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                <thead>
                    <tr>
                        <th class="table-th-app" style="font-size:25px;"><b>Всего</b> </th>
                        <th class="table-th-app" style="font-size:25px;">организаций:</th>
                        <th class="table-th-app" style="font-size:25px;"><?=$count_for_view?> </th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app" style="font-size:25px;"></th>
                        <th class="table-th-app"></th>   
                    </tr>
                </thead>  
            </table>
        <?php endif; ?>   
    </div>
   
</div>
<?php  file_include('/layers/footerAdmin.php'); ?>