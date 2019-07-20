<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
$id_tradingPlace ='';
if ($_GET['id_tradingPlace']) {
    $id_tradingPlace = $_GET['id_tradingPlace'];
}


$db = new Db();
$place = array();
$db->setQuery("SELECT * FROM `tradingPlace` WHERE `id_tradingPlace`='$id_tradingPlace'");
if ($db->getNumRows()){
    $place = $db->getObject(1);
}
// echo '<pre>';
// var_dump( $place);
// echo '</pre>';
if ($place->rented === '1') {
    $contract = array();
    $db->setQuery("SELECT   `o`.name_org,
                            `c`.`id_tr_place`,`c`.`num_contract`, `c`.`date_contract`, `c`.`id`,
                            `c`.`begin_arenda`, `c`.`end_arenda`,
                            `t`.`id_tradingPlace`
                    FROM `contract` AS `c`
                    INNER JOIN `organization`  AS `o` ON `o`.`id` = `c`.`id_org`
                    INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                    WHERE `c`.`id_tr_place`= '$id_tradingPlace ' ");
    if ($db->getNumRows()){
        $contract = $db->getObject(1);
    }
    $id_contract = $contract->id;
    if (!$id_contract) {
        $db->setQuery("SELECT `a`.`id`, `a`.`num_app`,`a`.`date_app`,`t`.`id_tradingPlace`,`o`.`name_org`
                        FROM `application` AS `a`
                        INNER JOIN `organization` AS `o` ON `o`.`id`=`a`.`id_org`
                        INNER JOIN `tradingPlace` AS `t` ON `t`.`id_tradingPlace`=`a`.`id_tr_place`
                        WHERE `a`.`id_tr_place`= '$id_tradingPlace ' ");
        if ($db->getNumRows()){
            $app = $db->getObject(1);
        }
        $id_app = $app->id;
    }
}

$date_contract = strtotime($contract->date_contract);
$date_contractForView = date("d.m.y", $date_contract);

$begin_arenda = strtotime($contract->begin_arenda);
$begin_arendaForView = date("d.m.y", $begin_arenda);

$end_arenda = strtotime($contract->end_arenda);
$end_arendaForView = date("d.m.y", $end_arenda);

$date_app = strtotime($app->date_app);
$date_appForView = date("d.m.y", $date_app);

$db->close();

file_include('/layers/headerAdmin.php', 'Торговые места');
?>


<div class="container">
    <h1>Торговое место № <?=$place->number_place ?> </h1>
    <div class="add-place">
        <div class="div-org-add">
                    <div class="div-org-edit-left">
                        <table class="table-app">
                           <tr>
                               <th>Этаж</th>
                               <td><?= $place->floor?></td>
                           </tr>
                           <tr>
                               <th>Площадь, м2</th>
                               <td><?=$place->size_square?></td>
                           </tr>
                           <tr>
                               <th>Ставка, $</th>
                               <td><?=$place->rate?></td>
                           </tr>
                           <tr>
                               <th>Статус</th>
                               <?php if( $place->rented === '1'):?>
                               <td>Арендовано</td>
                               <?php else :?>
                               <td>Не арендовано</td>
                               <?php endif ;?>
                           </tr>
                           <?php if( $place->rented === '1' && $id_contract):?>
                           <tr>
                                <th>Организация</th>
                                <td><?= $contract->name_org?></td>
                           </tr>
                           <tr>
                                <th>Договор</th>
                                <td><?=' № '. $contract->num_contract. ' от '. $date_contractForView?></td>
                           </tr>
                           <tr>
                                <th>Начало аренды</th>
                                <td><?=$begin_arendaForView?></td>
                           </tr>
                           <tr>
                                <th>Окончание аренды</th>
                                <td><?=$end_arendaForView?></td>
                           </tr>
                           <? elseif ($place->rented === '1' && $id_app):?>
                           <tr>
                                <th>Организация</th>
                                <td><?= $app->name_org?></td>
                           </tr>
                           <tr>
                                <th>Заявка</th>
                                <td><?=' № '. $app->num_app. ' от '. $date_appForView?></td>
                           </tr>
                           <?php endif ;?>
                        </table>
                    </div>
                    <div class="div-org-edit-right">
                        <div class="info-center">
                            <table class="table-app">
                                <tr>
                                    <img width="340px" height="300px" src="<?= url('/assets/img/tradingPlace/') . $place->image;?>">
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="add-app-footer " >
                   <a href="<?=url('/web/admin/tradingPlace/showTrPlace.php');?>" class="link-info" >  Закрыть</a>
                </div>
    </div>
</div>



<?php  file_include('/layers/footerAdmin.php'); ?>