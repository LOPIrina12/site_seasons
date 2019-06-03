<?php
include '../../library/core.php';
file_include('/library/Db.php');


$num_app ='';
if($_GET['num_app']) {
    $num_app= $_GET['num_app'];
}


if ($_GET && $_GET['num_app']) {
	$db=new Db();
	$db->setQuery("DELETE FROM `application` WHERE `num_app` = '$num_app'");
	$db->close();
}
/*header('Location: ' . url('/web/admin/'));*/

?>