<?php

include '../../library/core.php';
file_include("/library/word.php");
file_include('/library/Db.php');

if ($_GET['id_dog']) {
    $id_dog = $_GET['id_dog'];
}

$db = new Db();
$db->setQuery("SELECT   `o`.*,
                        `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                        `c`.`end_arenda`,`t`.`number_place`, `t`.`size_square`,  `t`.`rate`
                FROM `contract` AS `c`
                INNER JOIN `organization`  AS `o` ON `o`.`id` = `c`.`id_org`
                INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                WHERE `c`.`id`= '$id_dog ' ");

if ($db->getNumRows()){
$contract = $db->getObject(1);
}
    $num_contract = $contract->num_contract;
    $date_contract_not_format =$contract->date_contract;
    $date = strtotime($date_contract_not_format);
    $date_contract = date("d.m.y", $date);
    $name_org = $contract->name_org;
    $manager = $contract->manager;
    $number_place = $contract->number_place;
    $size_square = $contract->size_square;
    $begin_arenda = $contract->begin_arenda;
    $end_arenda = $contract->end_arenda;
    $ynp = $contract->ynp;
    $bik_bank = $contract->bik_bank;
    $bank = $contract->bank;
    $account = $contract->account;
    $adress = $contract->adress;
    $phone = $contract->phone;
    $e_mail = $contract->e_mail;

    $db->close();

Word::template_word("contract.docx", "contract_result.docx", array(
     
    'num_contract' => $num_contract, 
    'date_contract' => $date_contract,
    'name_org' => $name_org,
    'manager' => $manager,
    'number_place' => $number_place,
    'size_square' => $size_square,
    'begin_arenda' =>  $begin_arenda,
    'end_arenda' =>  $end_arenda,
    'ynp' => $ynp,
    'bik_bank' => $bik_bank,
    'bank' =>$bank,
    'account' => $account,
    'adress' => $adress,
    'phone' => $phone,
    'e_mail' => $e_mail

));

?>

<div></div>