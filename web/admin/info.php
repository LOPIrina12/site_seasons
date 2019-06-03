<?php
include '../../library/core.php';
file_include ('/library/Db.php');

access (['admin']);

file_include('/layers/headerAdmin.php', 'Информация о заявке');

$num_contract = '';
$date_conctract = '';
$date_end_contract= '';
$processed = '';
$rented ='';


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

$ynp = '';
if($_POST) {
    $ynp=$_POST['ynp'];
}

$db->setQuery("UPDATE `organization` SET `ynp`='$ynp' " );
$db->close();



?>
<div class="container">
    <?php if ($app):?>
            <h1>Заявка № <?=$app->num_app;?> от <?=$app->date_app;?> </h1>   
            <div class="table-info">
                <form class="form-edit" action="" method="POST">
                    <div class="div-info-up">
                        <div class="info-up-left">
                           
                                <table class="table-edit">
                                    <tr>
                                        <th>Код </th>
                                        <td> <input value="<?=$app->id_org;?>"  ></td>
                                    </tr>
                                    <tr>
                                        <th>Организация</th>
                                        <td> <input value="<?=$app->name_org;?>"></td>
                                    </tr>
                                     <tr>
                                        <th>УНП</th>
                                        <td><input name = "ynp" value="<?=$app->ynp;?>"></td>
                                    </tr>
                                     <tr>
                                        <th>Адрес</th>
                                        <td><?=$app->adress;?></td>
                                    </tr>
                                     <tr>
                                        <th>Телефон</th>
                                        <td><?=$app->phone;?></td>
                                    </tr>
                                     <tr>
                                        <th>Е-mail</th>
                                        <td><?=$app->e_mail;?></td>
                                    </tr>
                                     <tr>
                                        <th>Контактное лицо</th>
                                        <td><?=$app->fio;?></td>
                                    </tr>
                                   
                                </table>
                           
                        </div>
                        
                        <div class="info-up-right">
                            
                                <table class="table-edit">
                                    <tr>
                                        <th>Номер договора</th>
                                        <td><?=$app->num_contract;?></td>
                                    </tr>
                                     <tr>
                                        <th>Дата заключения договора</th>
                                        <td><?=$app->date_contract;?></td>
                                    </tr>
                                     <tr>
                                        <th>Дата окончания договора</th>
                                        <td><?=$app->date_end_contract;?></td>
                                    </tr>
                                     <tr>
                                        <th>Статус заявки</th>
                                        <td><?=$app->processed;?></td>
                                    </tr>
                                </table>
                           
                        </div>
                    </div>
                    
                    <div class="div-info-bot">
                       
                            <table>
                                <tr>
                                    <th>Код</th>
                                    <th>Номер торгового места</th>
                                    <th>Площадь, м2</th>
                                    <th>Ставка, $</th>
                                    <th>Статус</th>
                                </tr>
                                <tr>
                                    <td><?=$app->id_tr_place;?></td>
                                    <td><?=$app->number_place;?></td>
                                    <td><?=$app->size_square;?></td>
                                    <td><?=$app->rate;?></td>
                                    <td><?=$app->rented;?></td>
                                </tr>
                            </table>   
                       
                    </div>
                    
                    <div class="div-info-button">
                       <button type="submit" class="button-submit">Отправить</button>                  
                    </div>
                </form>   
            </div>
    <?php endif; ?>    
</div>

<?php file_include('/layers/footerAdmin.php');?>
   