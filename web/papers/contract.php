<?php

include '../../library/core.php';
file_include("/library/word.php");
file_include('/library/Db.php');

$num_app='';
if ($_GET['num_app']) {
    $num_app = $_GET['num_app'];
}

$db = new Db();
    $db->setQuery("SELECT `num_contract`,`date_contract` 
                    FROM `application` WHERE `num_app`='$num_app' LIMIT 1");
   
    if ($db->getNumRows()) {
        $applications=$db->getObject(1);
    }
    //var_dump($applications);
    
    $num_contract = $applications->num_contract;
    $date_contract_not_format =$applications->date_contract;
    $date = strtotime($date_contract_not_format);
    $date_contract = date("d.m.y", $date);

    $db->close();

Word::template_word("contract.docx", "contract_result.docx", array(
     
    'num_contract' => $num_contract, 
    'date_contract' => $date_contract

));

?>