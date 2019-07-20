<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

if ($_GET['id']){
    $id=$_GET['id'];
}

$db = new Db();

$contract = array();
$db->setQuery("SELECT   `o`.*,
                        `c`.`id`,`c`.`num_contract`, `c`.`date_contract`,`c`.`begin_arenda`,
                        `c`.`end_arenda`, `c`.`status`,
                        `t`.`number_place`, `t`.`rented`,`t`.`id_tradingPlace`
                FROM `contract` AS `c`
                INNER JOIN `organization`  AS `o` ON `o`.`id` = `c`.`id_org`
                INNER JOIN `tradingPlace`  AS `t` ON `t`.`id_tradingPlace` = `c`.`id_tr_place`
                WHERE `c`.`id`= '$id' ");
if ($db->getNumRows()){
    $contract = $db->getObject(1);
}

$tradingPlaces = NULL;
$db->setQuery("SELECT * FROM `tradingPlace` WHERE `rented`='0' ");
if($db->getNumRows()) {
    $tradingPlaces = $db->getObject();
}

$date_dog = $contract->date_contract;
$date_dogString = strtotime ($date_dog);
$date_dogView = date ("d.m.y", $date_dogString);

if($_POST) {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
   if ( $_POST['status'] || $_POST['begin_arenda'] || $_POST['end_arenda']) {
            $id= $_POST['id'];
            $status = $_POST['status'];
            $begin_arenda = $_POST['begin_arenda'];
            $end_arenda = $_POST['end_arenda'];
            $id_tr_place = $_POST['id_tr_place'];

            if($status === 'true') {
                $db -> setQuery ("UPDATE `contract` 
                SET `begin_arenda`= '$begin_arenda',`end_arenda`= '$end_arenda',`status`= '1' 
                WHERE `id`= '$id'");
                $db->setQuery ("UPDATE `tradingPlace` SET `rented`= '1'  WHERE `id_tradingPlace` = '$id_tr_place'");
            } else {
                $db -> setQuery ("UPDATE `contract` SET `status`= '0' WHERE `id`= '$id'");
                $db->setQuery ("UPDATE `tradingPlace` SET `rented`= '0'  WHERE `id_tradingPlace` = '$id_tr_place'");
            }
           

        header('Location: ' . url('/web/admin/contract/showContract.php'));
    }
}

$db->close();


file_include('/layers/headerAdmin.php', 'Добавить контракт');
?>

<div class="container">
    <form method="POST" action="<?=url('/web/admin/contract/editContract.php');?>">
        <div class="add-app">
            <div class="div-selector-add">
                <div class="title-form">
                    <div><input type="hidden" name="id" value="<?=$contract->id?>"></div>
                    <div><h1>Договор № <?= $contract->num_contract ?>   </h1></div>
                    <div><h1>   от <?= $date_dogView?> </h1></div>
                </div>
               <div class="div-selector">  
                    <select class="select"  name="status">
                        <?php if ($contract->status == '1') :?>
                        <option  value="true" <?= ($status == 'true') ? 'selected' : '';?> >
                        Действуйющий</option> 
                        <option  value="false" <?= ($status == 'false') ? 'selected' : '';?> >
                        Не действующий</option>
                        <?else :?>
                        <option  value="false" <?= ($status == 'false') ? 'selected' : '';?> >
                        Не действующий</option>
                        <option  value="true" <?= ($status == 'true') ? 'selected' : '';?> >
                        Действуйющий</option> 
                        <? endif;?>
                    </select> 
                       
                </div>
            </div> 
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th>Организация</th>
                            <td>
                                <input type="text" name="name_org" value="<?=$contract->name_org?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <th>УНП</th>
                            <td><input type="text" name="ynp" value="<?=$contract->ynp?>" disabled> </td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td><input type="text" name="adress" value="<?=$contract->adress  ?>"disabled ></td>
                        </tr>
                    </table>
                </div>
                    <div class="div-org-edit-right">
                        <table class="table-app">
                            <tr>
                                <th>Телефон</th>
                                <td><input type="text" name="phone" value="<?=$contract->phone?>" disabled></td>
                            </tr>
                            <tr>
                                <th>Контактное лицо</th>
                                <td><input type="text" name="fio" value="<?=$contract->fio?>" disabled></td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td><input type="text" name="e_mail" value="<?=$contract->e_mail?>" disabled></td>
                            </tr>   
                        </table>
                    </div>
                </div>
                <div >
                <table class="table-app">
                        <thead>
                            <tr>
                                <th class="table-th-app">Номер т.м.</th>
                                <th class="table-th-app">Статус</th>
                                <th class="table-th-app">Начало аренды</th>
                                <th class="table-th-app">Окончание аренды</th>
                            </tr>
                            <tr>
                                <td class="table-td-app">
                                    <input type="hidden" name="id_tr_place" value="<?=$contract->id_tradingPlace?>" >
                                    <input  disabled  value="<?=$contract->number_place?>">   
                                </td>
                                <td class="table-td-app">
                                    <?php if ($contract->rented === '1') :?>
                                    <input disabled value="Арендовано">
                                    <? else :?>
                                    <input disabled value="Не арендовано">
                                    <? endif ;?>

                                </td>
                                <td class="table-td-app"><input type="date" 
                                    name="begin_arenda" value="<?=$contract->begin_arenda?>"></td>
                                <td class="table-td-app"><input type="date" 
                                    name="end_arenda" value="<?=$contract->end_arenda?>"></td>
                                <td class="table-td-app">
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="add-app-footer  button-group">
                    <button type="submit" class="button button-info" name="editContract">Сохранить</button>
                    <a href="<?=url('/web/admin/contract/showContract.php'); ?>" class="link-info">Отменить</a>
                </div>
        </div>    
    </form>   
</div>
<?php  file_include('/layers/footerAdmin.php'); ?>

