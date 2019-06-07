<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
file_include('/layers/headerAdmin.php', 'Редактировать заявку');

$num_app ='';
if($_GET['num_app']) {
   $num_app=$_GET['num_app'];
}

$db = new Db();
$db->setQuery("SELECT `a`.`id_org`,`a`.`id_tr_place`, `a`.`num_app`,`a`.`date_app`,`a`.`num_contract`,`a`.`date_contract`,`a`.`date_end_contract`,`a`.`processed`,
`t`.*, 
`o`. *
FROM `application` AS `a`
JOIN `tradingPlace` AS `t` ON `a`.`id_tr_place`=`t`.`id_tradingPlace`
JOIN `organization` AS `o` ON `a`.`id_org`=`o`.`id`
WHERE `num_app` = '$num_app'
LIMIT 1");


$app = null;
if ($db->getNumRows()) {
    $app = $db->getObject(1);
}
$db->close();
?>
