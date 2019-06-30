<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

$num_app ='';
if($_GET['num_app']) {
   $num_app=$_GET['num_app'];
}
$db = new Db();
$db->setQuery("SELECT `a`.`id`,`a`.`id_org`,`a`.`id_tr_place`, `a`.`num_app`,`a`.`date_app`,`a`.`num_contract`,
`a`.`date_contract`,`a`.`processed`,`a`.`begin_arenda`,`a`.`end_arenda`,
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

$date_format = $app->date_app;
$date = strtotime ($date_format);
$myFormatForView = date("d.m.y", $date);

$num_contract_last = '';
$db->setQuery("SELECT `num_contract` FROM `application` ORDER BY `num_contract` DESC LIMIT 1");
if ($db->getNumRows()){
    $num_contract_last=$db->getObject(1)->num_contract;
} 

$processed = '';
// echo '<pre>';
// var_dump($app);
// echo '</pre>';

if ($_POST) {
    if ($_POST['processed'] || $_POST['num_app']
    || $_POST['num_contract'] || $_POST['date_contract'] || $_POST['date_end_contract']
    || $_POST['rented'] || $_POST['id_tradingPlace'] ||$_POST ['begin_arenda'] || $_POST ['end_arenda']) {
        $processed = $_POST['processed'];
        $num_app = $_POST['num_app'];
        $num_contract = $_POST ['num_contract'];
        $date_contract = $_POST ['date_contract'];
        $begin_arenda = $_POST['begin_arenda'];
        $end_arenda = $_POST['end_arenda'];
       // $date=date("Y-m-d",strtotime($date_contract));
        $rented = $_POST ['rented'];
        $id_tradingPlace=$_POST ['id_tradingPlace'];
            if ($processed === "true") {
                if ($rented === "true") {
                    $db->setQuery ("UPDATE `application` 
                    SET `processed`= '1' ,`num_contract`='$num_contract',
                    `date_contract`='$date_contract', `begin_arenda`='$begin_arenda', `end_arenda`='$end_arenda'
                    WHERE  `num_app`='$num_app'");
                    $db->setQuery("UPDATE `tradingPlace` 
                    SET `rented`= '1' 
                    WHERE  `id_tradingPlace`='$id_tradingPlace'");
                } else {
                    $db->setQuery("UPDATE `tradingPlace` 
                    SET `rented`= '0' 
                    WHERE  `id_tradingPlace`='$id_tradingPlace'");
                    $db->setQuery("UPDATE `application` 
                    SET `processed`= '1',`num_contract`=NULL, `date_contract`=NULL, `begin_arenda`=NULL, `end_arenda`= NULL
                    WHERE  `num_app`='$num_app'");
                }  
            }
              else {
                $db->setQuery ("UPDATE `application` SET `processed`= '0'  WHERE  `num_app`='$num_app'");
            }                
        header('Location: ' . url('/web/admin'));
    } 
}   
$db->close();
file_include('/layers/headerAdmin.php', 'Редактировать заявку');
?>

<div class="container">
    <form id="form-edit" method="POST" action="<?=url('/web/admin/app/editApp.php');?>">    
            <div class="add-app">  
                <div class="div-selector-add">
                    <div>
                        <h1>Заявка на аренду № <?=$num_app?> от <?=$myFormatForView;?> </h1>
                        <?php if($num_app): ?>
                                <input type="hidden" name="num_app" value="<?= $num_app; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="div-selector">  
                        <select class="select"  name="processed">
                            <?php if ($app->processed === '1') :?>
                            <option  value="true" <?= ($processed == 'true') ? 'selected' : '';?> >Обработано</option>
                            <option  value="false" <?= ($processed == 'false') ? 'selected' : '';?> >Не обработано</option>
                            <?else :?>
                            <option  value="false" <?= ($processed == 'false') ? 'selected' : '';?> >Не обработано</option>
                            <option  value="true" <?= ($processed == 'true') ? 'selected' : '';?> >Обработано</option>
                            <?php endif?>
                        </select>    
                    </div>
                </div>
                <div class="info">
                    <a href="<?=url('/web/papers/contract.php?num_app=' . $app->num_app);?>"
                    class="link-info _contract">Договор</a>
                </div> 
                <div class="div-org-add">
                    <div class="div-org-edit-left">
                        <table class="table-app">
                           <tr>
                               <th>Организация</th>
                               <td><input disabled id="name_org" type = "text" name="name_org" value="<?=$app->name_org?>"></td>
                           </tr>
                           <tr>
                               <th>УНП</th>
                               <td><input disabled id="ynp" type="text" name="ynp" value="<?=$app->ynp?>"></td>
                           </tr>
                           <tr>
                               <th>Адрес</th>
                               <td><input disabled id="adress" type="text" name="adress" value="<?=$app->adress?>"></td>
                           </tr>
                        </table>
                    </div>
                    <div class="div-org-edit-right">
                        <table class="table-app">
                            <tr>
                                <th>Телефон</th>
                                <td><input disabled value="<?=$app->phone?>"></td>
                            </tr>
                            <tr>
                                <th>Контактное лицо</th>
                                <td><input disabled value="<?=$app->fio?>"></td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td><input disabled value="<?=$app->e_mail?>"></td>
                            </tr>   
                        </table>
                    </div>
                </div>
                <div >
                    <table class="table-app">
                        <thead>
                            <tr>
                                <th class="table-th-app">Номер договора</th>
                                <th class="table-th-app">Дата заключения договора</th>
                                <th class="table-th-app">Начало аренды</th>
                                <th class="table-th-app">Окончание аренды</th>
                            </tr>
                            <tr>
                                <?php if ($app->num_contract === '' || $app->num_contract === NULL) :?>
                                <td class="table-td-app"><input type="text" name="num_contract"
                                    placeholder= "<?=$num_contract_last +1?>"></td>   
                                <?php else :?>
                                <td class="table-td-app"><input type="text" name="num_contract"
                                    value="<?=$app->num_contract?>"></td>
                                <?php endif?>
                                <td class="table-td-app">
                                <input type="date" value="<?=$app->date_contract?>" name="date_contract">
                                </td>
                                <td class="table-td-app">
                                <input type="date" value="<?=$app->begin_arenda?>" name="begin_arenda">
                                </td>
                                <td class="table-td-app">
                                <input type="date" value="<?=$app->end_arenda?>" name="end_arenda">
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div >
                    <table class="table-app">
                            <thead>
                                <tr>
                                    <th class="table-th-app">Номер т.м.</th>
                                    <th class="table-th-app">Площадь, м2</th>
                                    <th class="table-th-app">Ставка, $</th>
                                    <th class="table-th-app">Статус</th>
                                </tr>
                                <tr>
                                    <td class="table-td-app">
                                        <input type="hidden" name="id_tradingPlace"value="<?=$app->id_tradingPlace?>">
                                        <input  type="text" 
                                        name="number_place" value="<?=$app->number_place?>" disabled>
                                    </td>
                                        <td class="table-td-app"><input  type="text" 
                                        name="size_square" value="<?=$app->size_square?>" disabled>
                                    </td>
                                        <td class="table-td-app"><input type="text"
                                        name="rate" value="<?=$app->rate?>" disabled>
                                    </td>
                                    <td class="table-td-app">
                                        <div class="div-selector">  
                                            <select class="select"  name="rented">
                                                <?php if ($app->rented === '1') :?>
                                                <option  value="true" <?= ($rented == 'true') ? 'selected' : '';?> >Арендовано</option>
                                                <option  value="false" <?= ($rented == 'false') ? 'selected' : '';?> >Не арендовано</option>
                                                <? else :?>
                                                <option  value="false" <?= ($rented == 'false') ? 'selected' : '';?> >Не арендовано</option>
                                                <option  value="true" <?= ($rented == 'true') ? 'selected' : '';?> >Арендовано</option>
                                                <? endif?>
                                                </select>    
                                        </div>
                                    
                                    </td>
                                </tr>
                            </thead>
                    </table>
                </div>
                <div class="add-app-footer  button-group">
                    <button type="submit" class="button button-info" name="edit">Сохранить</button>
                    <a href="<?=url('/web/admin'); ?>" class="link-info">Отменить</a>
                </div>
            </div>    
    </form> 
</div>

<?php  file_include('/layers/footerAdmin.php'); ?>
