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
if ($_POST){
    if ($_POST['begin_arenda'] && $_POST['end_arenda']) {
        $begin_arenda = $_POST['begin_arenda'];
        $end_arenda = $_POST['end_arenda'];
        $db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                              `c`.`end_arenda`, `c`.`status`,
                              `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$begin_arenda' AND `end_arenda` >='$end_arenda'");

        if ($db->getNumRows()){
            $trPlaces = array();
            $trPlaces=$db->getObject();
            // echo '<pre>';
            // var_dump($trPlaces);
            // echo '</pre>';
            $quantity= count($trPlaces)+1;
            $quantityNotRented = $count_for_view - $quantity;
           
        }
        $db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                                `c`.`end_arenda`, `c`.`status`,
                                `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$begin_arenda' AND `end_arenda` >='$end_arenda' AND `floor` = 1");
            if ($db->getNumRows()){
                $firstFloor = array();
                $firstFloor=$db->getObject();
                // echo '<pre>';
                // var_dump($trPlaces);
                // echo '</pre>';
                $firstForView= count($firstFloor);
                $quantityNotRented = $count_for_view - $quantity;
               
            }  
        
        $db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                                `c`.`end_arenda`, `c`.`status`,
                                `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$begin_arenda' AND `end_arenda` >='$end_arenda' AND `floor` = 2");
            if ($db->getNumRows()){
            $secondFloor = array();
            $secondFloor=$db->getObject();
            // echo '<pre>';
            // var_dump($trPlaces);
            // echo '</pre>';
            $secondForView= count($secondFloor);
            

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
            <form method="POST" action="<?= url('/web/admin/report/appReport.php')?>">
            <h1>Статистика по торговым местам</h1>
            <div class="title-form">
                <div><h2>за период </h2></div>
                <div><h2>с</h2></div>
                <div><input class="input-num" type="date" name="begin_arenda" value="<?=$current_date?>"></div>
                <div><h2>по</h2></div>
                <div><input class="input-num" type="date" name="end_arenda" value="<?=$current_date?>"></div>
                <div class="add-app-footer  button-group">
                    <button type="submit" class="button button-info" name="edit">Сформировать</button>
                </div>
            </div>    
            </form>
        </div>
        <?php else:?>
        <div>
            <form method="POST" action="<?= url('/web/admin/report/appReport.php')?>">
            <h1>Статистика по торговым местам</h1>
            <div class="title-form">
                <div><h2>за период </h2></div>
                <div><h2>с</h2></div>
                <div><input class="input-num" type="date" name="begin_arenda" value="<?=$begin_arenda?>"></div>
                <div><h2>по</h2></div>
                <div><input class="input-num" type="date" name="end_arenda" value="<?=$end_arenda?>"></div>
                <div class="add-app-footer  button-group">
                    <button type="submit" class="button button-info" name="edit">Сформировать</button>
                </div>
            </div>    
            </form>
        </div>
        <div style="margin-top: 30px;">
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th>Всего торговых мест:</th>
                            <td><?=$count_for_view?></td>
                        </tr>
                        <tr>
                            <th>из них:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Арендовано:</th>
                            <td><?=$quantity?></td>
                        </tr>
                        <tr>
                            <th>- 1 этаж</th>
                            <td><?=$firstForView?></td>
                        </tr>
                        <tr>
                            <th>- 2 этаж</th>
                            <td><?=$secondForView?></td>
                        </tr>
                        <tr>
                            <th>- 3 этаж</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Не арендовано</th>
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