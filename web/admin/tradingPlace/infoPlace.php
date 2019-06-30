<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
$id_tradingPlace ='';
if ($_GET['id_tradingPlace']) {
    $id_tradingPlace = $_GET['id_tradingPlace'];
}


$db = new Db();

$db->setQuery ("SELECT `rented` FROM `tradingPlace` 
                WHERE `id_tradingPlace` = '$id_tradingPlace' LIMIT 1");

if ($db->getNumRows()) {
$rented = $db->getObject(1)->rented;
}
$place = null;

if($rented === '1') {
    $db->setQuery ("SELECT *, `t`.*
    FROM `application` AS `a`
    INNER JOIN `tradingPlace` AS `t` ON `a`.`id_tr_place`=`t`.`id_tradingPlace`
    WHERE `id_tradingPlace` = '$id_tradingPlace' LIMIT 1");

    if ($db->getNumRows ()) {
    $place = $db->getObject(1);
    }
}
else {
    $db->setQuery ("SELECT * FROM `tradingPlace`  
    WHERE `id_tradingPlace` = '$id_tradingPlace' LIMIT 1 ");
    if ($db->getNumRows ()) {
        $place = $db->getObject(1);
    }
}

// echo '<pre>';
// var_dump( $place);
// echo '</pre>';

$date_contract = strtotime($place->date_contract);
$date_contractForView = date("d.m.y", $date_contract);

$begin_arenda = strtotime($place->begin_arenda);
$begin_arendaForView = date("d.m.y", $begin_arenda);

$end_arenda = strtotime($place->end_arenda);
$end_arendaForView = date("d.m.y", $end_arenda);

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
                               <th>Код</th>
                               <td><?= $place->id_tradingPlace?></td>
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
                           <tr>
                                <th>Договор</th>
                                <?php if( $place->rented === '1'):?>
                                <td><?=' № '. $place->num_contract. ' от '. $date_contractForView?></td>
                                <?php else:?>
                                <td><?=''?></td>
                                <?php endif ;?>
                           </tr>
                           <tr>
                                <th>Начало аренды</th>
                                <?php if( $place->rented === '1'):?>
                                <td><?=$begin_arendaForView?></td>
                                <?php else:?>
                                <td><?= ' '?></td>
                                <?php endif ;?>
                               
                           </tr>
                           <tr>
                                <th>Окончание аренды</th>
                                <?php if( $place->rented === '1'):?>
                                <td><?=$end_arendaForView?></td>
                                <?php else:?>
                                <td><?= ' '?></td>
                                <?php endif ;?>
                               
                           </tr>
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