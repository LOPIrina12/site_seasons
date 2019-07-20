<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

if ($_GET['id']) {
    $id_dog = $_GET['id'];
}

$db = new Db();
$contract = array();
$db->setQuery("SELECT   `o`.*,
                        `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`, `c`.`end_arenda`,
                        `t`.`number_place`, `t`.`size_square`,  `t`.`rate`
                FROM `contract` AS `c`
                INNER JOIN `organization`  AS `o` ON `o`.`id` = `c`.`id_org`
                INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                WHERE `c`.`id`= '$id_dog ' ");
if ($db->getNumRows()){
    $contract = $db->getObject(1);
}

$date_dog = $contract->date_contract;
$date_dogString = strtotime ($date_dog);
$date_dogView = date ("d.m.y", $date_dogString);

$db->close();

file_include('/layers/headerAdmin.php', 'Просмотр контракта');
?>

<div class="container">
    <?php if ($contract) :?>
    <h1>Договор № <?= $contract->num_contract?> от <?= $date_dogView ?> </h1>
    <div class="info">
        <a href="<?=url('/web/papers/contract.php?id_dog=' . $id_dog);?>"
        class="link-info _contract">Просмотр</a>
    </div> 
    <div class="add-place">
        <div class="div-org-add">
            <div class="div-org-edit-left">
                <table class="table-app">
                    <tr>
                        <th>Организация</th>
                        <td><?= $contract->name_org?></td>
                    </tr>
                    <tr>
                        <th>УНП</th>
                        <td><?= $contract->ynp?></td>
                    </tr>
                    <tr>
                        <th>БИК-Банка</th>
                        <td><?= $contract->bik_bank?></td>
                    </tr>
                    <tr>
                        <th>Банк</th>
                        <td><?= $contract->bank?></td>
                    </tr>
                    <tr>
                        <th>Расчётный счёт</th>
                        <td><?= $contract->account?></td>
                    </tr>
                </table>
            </div>
            <div class="div-org-edit-right">
                <table class="table-app">
                    <tr>
                        <th>Адрес</th>
                        <td><?= $contract->adress?></td>
                    </tr>
                    <tr>
                        <th>Телефон</th>
                        <td><?= $contract->phone?></td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><?= $contract->e_mail?></td>
                    </tr>
                    <tr>
                        <th>Руководитель</th>
                        <td><?= $contract->manager?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div >
            <table class="table-app">
                <thead>
                    <tr>
                        <th class="table-th-app">Торговое место</th>
                        <th class="table-th-app">Площадь, м2</th>
                        <th class="table-th-app">Стоимость 1 м2, $</th>
                        <th class="table-th-app">Начало аренды</th>
                        <th class="table-th-app">Окончание аренды</th>
                    </tr>
                    <tr>
                        <td class="table-td-app"><?= $contract->number_place?></td>
                        <td class="table-td-app"><?= $contract->size_square?></td>
                        <td class="table-td-app"><?= $contract->rate?></td>
                        <td class="table-td-app"><?= $contract->begin_arenda?></td>
                        <td class="table-td-app"><?= $contract->end_arenda?></td> 
                    </tr>
                </thead>
            </table>
        </div>   
        <div class="add-app-footer " >
            <a href="<?=url('/web/admin/contract/showContract.php');?>" class="link-info" >  Закрыть</a>
        </div>
    </div>
    <?php endif ;?>
</div>

<?php  file_include('/layers/footerAdmin.php'); ?>