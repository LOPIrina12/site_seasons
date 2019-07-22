<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

$db = new Db();
$db->setQuery ("SELECT * FROM `tradingPlace`");
$places = array();
if ($db->getNumRows()) {
    $places = $db->getObject();
}

$status=$places->rented;

$db->setQuery ("SELECT COUNT(`id_tradingPlace`) AS `count` FROM `tradingPlace`");
if ($db->getNumRows ()) {
    $count = $db->getObject(1);
}
$count_for_view=$count->count;

$db->setQuery ("SELECT COUNT(*) AS `count` FROM `tradingPlace` WHERE `rented`=1");
if ($db->getNumRows ()) {
    $count = $db->getObject(1);
}
$countRented=$count->count;

$db->setQuery ("SELECT COUNT(*) AS `count` FROM `tradingPlace` WHERE `rented`=0");
if ($db->getNumRows ()) {
    $count = $db->getObject(1);
}
$countNotRented=$count->count;
$db->close();

file_include('/layers/headerAdmin.php', 'Торговые места');
?>

<div class="container">
    <h1>Справочник: Торговые места</h1>
    <div class="info">
        <a href="<?=url('/web/admin/tradingPlace/addTrPlace.php');?>"class="link-info _contract">Добавить</a>
    </div> 
    <div class="content">
    <?php if ($places):?>       
            <table class="table-app">
                <thead>
                    <tr>
                        <th class="table-th-app">Код</th>
                        <th class="table-th-app">Торговое место</th>
                        <th class="table-th-app">Площадь, м2</th>
                        <th class="table-th-app">Ставка, $</th>
                        <th class="table-th-app">Статус</th>
                        <th class="table-th-app">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($places as $place):?>
                        <tr>
                            <td class="table-td-app"><?= $place->id_tradingPlace;?></td>
                            <td class="table-td-app"><?= $place->number_place;?></td>
                            <td class="table-td-app"><?= $place->size_square;?></td>
                            <td class="table-td-app"><?= $place->rate;?></td>
                            <?php if ($place->rented === '1'):?>
                            <td class="table-td-app">Арендовано</td>
                            <?php else:?>
                            <td class="table-td-app">Не арендовано</td>
                            <? endif; ?>
                            <td>
                                <div class="table-app-btn-group">
                                    <a href="<?=url('/web/admin/tradingPlace/infoPlace.php?id_tradingPlace=' . $place->id_tradingPlace);?>" 
                                        title="Просмотреть" 
                                        class="table-app-btn _eye"><i class="fa fa-eye"></i></a>
                                    <a href="<?=url('/web/admin/tradingPlace/editPlace.php?id_tradingPlace=' . $place->id_tradingPlace)?>"
                                        title="Редактировать" 
                                        class="table-app-btn _edit"><i  class="fa fa-edit"></i></a>               
                                    <a href="<?=url('/web/admin/tradingPlace/delPlace.php?id_tradingPlace=' . $place->id_tradingPlace);?>"
                                        title="Удалить" 
                                        class="table-app-btn _trash"> <i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                           
                        </tr>
                     <?php endforeach ;?>      
                </tbody>
                <thead>
                    <tr>
                        <th class="table-th-app"></th>
                        <th class="table-th-app" style="font-size:22px;">Всего, шт. :</th>
                        <th class="table-th-app" style="font-size:22px;"><?=$count_for_view?></th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app"></th>
                    </tr>
                    <tr>
                        <th class="table-th-app"></th>
                        <th class="table-th-app" style="font-size:18px;">Арендовано:</th>
                        <th class="table-th-app" style="font-size:18px;"><?=$countRented?></th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app"></th>
                    </tr>
                    <tr>
                        <th class="table-th-app"></th>
                        <th class="table-th-app" style="font-size:18px;">Не арендовано:</th>
                        <th class="table-th-app" style="font-size:18px;"><?=$countNotRented?></th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app"></th>
                        <th class="table-th-app"></th>
                    </tr>
                </thead>
            </table>        
    <?php endif;?>   
    </div>
</div>


<?php  file_include('/layers/footerAdmin.php'); ?>