<?php
include '../../../library/core.php';
file_include('/library/Db.php');


$id_tradingPlace ='';
if($_GET['id_tradingPlace']) {
    $id_tradingPlace= $_GET['id_tradingPlace'];
}


if ($_GET && $_GET['id_tradingPlace']) {


	$db=new Db();
	$db->setQuery("DELETE FROM `tradingPlace` WHERE `id_tradingPlace` = '$id_tradingPlace'");
	$db->close();
}
header('Location: ' . url('/web/admin/tradingPlace/showTrPlace.php'));

?>