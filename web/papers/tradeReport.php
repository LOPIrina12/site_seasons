<?php

include '../../library/core.php';
file_include("/library/word.php");
file_include('/library/Db.php');

if ($_GET['date']) {
    $date = $_GET['date'];
}

$date_String = strtotime ($date);
$date_View = date ("d.m.y", $date_String);

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

$db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                              `c`.`end_arenda`, `c`.`status`,
                              `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$date' AND `end_arenda` >='$date'");
if ($db->getNumRows()){
    $trPlaces = array();
    $trPlaces=$db->getObject();
    $quantityRentedPlace= count($trPlaces);  
}

$quantityNotRented = $count_for_view - $quantityRentedPlace;

$db->setQuery("SELECT `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                                `c`.`end_arenda`, `c`.`status`,
                                `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`,`t`.`floor`
                        FROM `contract` AS `c`
                        INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                        WHERE `begin_arenda`<='$date' AND `end_arenda` >='$date' AND `floor`=1");
            if ($db->getNumRows()){
                $firstFloor = array();
                $firstFloor=$db->getObject();
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
            $thirdForView= count($thirdFloor);   
            }           
$db->close();



Word::template_word("statisticTrPlace.docx", "statisticTrPlace_result.docx", array(
     
    'date' => $date_View,
    'count_for_view' => $count_for_view,
    'firstFloorCount' => $firstFloorCount,
    'secondFloorCount' => $secondFloorCount,
    'thirdFloorCount' => $thirdFloorCount,
    'quantityRentedPlace' =>$quantityRentedPlace,
    'NotRented' => $quantityNotRented,
    'firstForView' =>  $firstForView,
    'secondForView' => $secondForView,
    'thirdForView' => $thirdForView
    
));

?>
