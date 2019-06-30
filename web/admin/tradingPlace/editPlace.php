<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);


file_include('/layers/headerAdmin.php', 'Торговые места');
?>

<?php  file_include('/layers/footerAdmin.php'); ?>