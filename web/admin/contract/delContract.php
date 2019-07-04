<?php
include '../../../library/core.php';
file_include('/library/Db.php');


$id ='';
if($_GET['id']) {
    $id= $_GET['id'];
}


if ($_GET && $_GET['id']) {


	$db=new Db();
	$db->setQuery("DELETE FROM `contract` WHERE `id` = '$id'");
	$db->close();
}
header('Location: ' . url('/web/admin/org/showOrg.php'));

?>
