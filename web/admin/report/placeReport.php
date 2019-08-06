<?php
include '../../../library/core.php';
file_include('/library/Db.php');

$current_date=date('Y-m-d');
$db = new Db();
$db->setQuery ("SELECT COUNT(`id_tradingPlace`) AS `count` FROM `tradingPlace`");
if ($db->getNumRows ()) {
    $count = $db->getObject(1);
}
$count_for_view=$count->count;
$db->setQuery ("SELECT COUNT(`id_tradingPlace`) AS `count` FROM `tradingPlace` WHERE `floor`=1");
if ($db->getNumRows ()) {
    $count = $db->getObject(1);
}
$firstFloorCount=$count->count;

$db->setQuery ("SELECT COUNT(`id_tradingPlace`) AS `count` FROM `tradingPlace` WHERE `floor`=2");
if ($db->getNumRows ()) {
    $countSecond = $db->getObject(1);
}
$secondFloorCount=$countSecond->count;

$db->setQuery ("SELECT COUNT(`id_tradingPlace`) AS `count` FROM `tradingPlace` WHERE `floor`=3");
if ($db->getNumRows ()) {
    $countThird = $db->getObject(1);
}
$thirdFloorCount=$countThird->count;

if ($_POST){
    if ($_POST['begin_arenda']) {
        $date = $_POST['begin_arenda'];
        $db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                              `c`.`end_arenda`, `c`.`status`,
                              `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$date' AND `end_arenda` >='$date'");

        if ($db->getNumRows()){
            $trPlaces = array();
            $trPlaces=$db->getObject();
            // echo '<pre>';
            // var_dump($trPlaces);
            // echo '</pre>';
            $quantity= count($trPlaces);
            $quantityNotRented = $count_for_view - $quantity;
           
        }
        $db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                                `c`.`end_arenda`, `c`.`status`,
                                `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$date' AND `end_arenda` >='$date' AND `floor`=1");
            if ($db->getNumRows()){
                $firstFloor = array();
                $firstFloor=$db->getObject();
                // echo '<pre>';
                // var_dump($firstFloor);
                // echo '</pre>';
                $firstForView= count($firstFloor);
              
               
            }  
        
        $db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                                `c`.`end_arenda`, `c`.`status`,
                                `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$date' AND `end_arenda` >='$date' AND `floor`=2");
            if ($db->getNumRows()){
            $secondFloor = array();
            $secondFloor=$db->getObject();
            // echo '<pre>';
            // var_dump($secondFloor);
            // echo '</pre>';
            $secondForView= count($secondFloor);
        } 
        $db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                                `c`.`end_arenda`, `c`.`status`,
                                `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$date' AND `end_arenda` >='$date' AND `floor`=3");
            if ($db->getNumRows()){
            $thirdFloor = array();
            $thirdFloor=$db->getObject();
            // echo '<pre>';
            // var_dump($secondFloor);
            // echo '</pre>';
            $thirdForView= count($thirdFloor);   
            }              
    }

}
$db->close();
file_include('/layers/headerAdmin.php', 'Заявка на аренду');
?>

<div class="container">
    <div class="container-center-row">
        <?php if(!$quantity):?>
        <div>
            <form method="POST" action="<?= url('/web/admin/report/placeReport.php')?>">
            <h1>Сведения по торговым местам</h1>
            <div class="title-form">
                <div><h2>на </h2></div>
                <div><input class="input-num" type="date" name="begin_arenda" value="<?=$current_date?>"></div>
                <div class="add-app-footer  button-group">
                    <button type="submit" class="button button-info" name="edit">Сформировать</button>
                </div>
                <div><input class="input-num" type="hidden" name="end_arenda" value=""></div>
            </div>    
            </form>
        </div>
        <?php else:?>
        <div>
            <form method="POST" action="<?= url('/web/admin/report/appReport.php')?>">
                <h1>Сведения по торговым местам</h1>
                <div class="title-form">
                    <div><h2>на </h2></div>
                    <div><input class="input-num" type="date" name="begin_arenda" value="<?=$date?>"></div>
                    
                    <div class="info">
                        <a href="<?=url('/web/papers/tradeReport.php?date=' . $date);?>"
                            class="link-info _contract">Просмотр</a>
                    </div> 
                    <div><input class="input-num" type="hidden" name="end_arenda" value=""></div>
                </div>    
            </form>
        </div>
        <div style="margin-top: 30px;">
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th><b style="font-size:20px">Всего торговых мест:</b></th>
                            <td><?=$count_for_view?></td>
                        </tr>
                        <tr>
                            <th>в том числе:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th><b>-1 этаж</b>:</th>
                            <td><?=$firstFloorCount?></td>
                        </tr>
                        <tr>
                            <th><b>-2 этаж</b>:</th>
                            <td><?=$secondFloorCount?></td>
                        </tr>
                        <tr>
                            <th><b>-3 этаж</b>:</th>
                            <td><?=$thirdFloorCount?></td>
                        </tr>
                        <tr>
                            <th>из них:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th><b style="font-size:20px">Арендовано:</b></th>
                            <td><?=$quantity?></td>
                        </tr>
                        <tr>
                            <th>-- 1 этаж</th>
                            <td><?=$firstForView?></td>
                        </tr>
                        <tr>
                            <th>-- 2 этаж</th>
                            <td><?=$secondForView?></td>
                        </tr>
                        <tr>
                            <th>-- 3 этаж</th>
                            <td><?=$thirdForView?></td>
                        </tr>
                        <tr>
                            <th><b style="font-size:20px">Не арендовано:</b></th>
                            <td><?=$quantityNotRented?></td>
                        </tr>
                    </table>
                </div>
                <div class="div-org-edit-right"></div>
            </div>
        </div>
        <?php endif;?>
    </div>
    

    
</div>


<?php file_include ('/layers/footerAdmin.php');?> 