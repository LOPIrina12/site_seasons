<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
if ($_GET['id']){
    $id=$_GET['id'];
}
$db= new Db();
$db->setQuery("SELECT * FROM `organization` WHERE `id`='$id'");
$org=NULL;
if ($db->getNumRows()){
    $org = $db->getObject(1);
}
 if ($_POST){
    //  echo '<pre>';
    //  var_dump ($_POST);
    //  echo '</pre>';
    if($_POST['id'] || $_POST['name_org']|| $_POST['ynp'] || $_POST['bik_bank'] || $_POST['bank'] ||
       $_POST['account'] || $_POST['adress'] || $_POST['phone'] || $_POST['e_mail'] ||
       $_POST['fio'] || $_POST['manager']) {
          $id=$_POST['id'];
          $name_org=$_POST['name_org'];
          $ynp=$_POST['ynp'];
          $bik_bank=$_POST['bik_bank'];
          $bank=$_POST['bank'];
          $account=$_POST['account'];
          $adress=$_POST['adress'];
          $phone=$_POST['phone'];
          $e_mail=$_POST['e_mail'];
          $fio=$_POST['fio'];
          $manager=$_POST['manager'];
          $db->setQuery("UPDATE `organization` 
                        SET `name_org`='$name_org', `ynp`='$ynp',`bik_bank`='$bik_bank',`bank`='$bank',
                        `account`='$account',`adress`='$adress',`phone`='$phone',`e_mail`='$e_mail',
                        `fio`='$fio',`manager`='$manager'
                        WHERE `id`='$id'");

    }
    header('Location:' . url('/web/admin/org/showOrg.php'));
   
 }
$db->close();

file_include('/layers/headerAdmin.php', 'Редактировать организацию');
?>
<div class="container">
    <form action="<?= url('/web/admin/org/editOrg.php')?>" method="POST">
        <div class="add-place">
            <h1>Справочник: Организации</h1>
            <input type="hidden" name="id" value="<?=$org->id?>">
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th>Организация</th>
                            <td><input name="name_org"  value="<?=$org->name_org?>"></td>    
                        </tr>
                        <tr>
                            <th>УНП</th>
                            <td><input name="ynp" value="<?=$org->ynp?>"></td>
                        </tr>
                        <tr>
                            <th>БИК-Банка</th>
                            <td><input name="bik_bank" value="<?=$org->bik_bank?>"></td>
                        </tr>
                        <tr>
                            <th>Банк</th>
                            <td><input name="bank" value="<?=$org->bank?>"></td>
                        </tr>
                        <tr>
                            <th>Расчётный счёт</th>
                            <td><input name="account" value="<?=$org->account?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="div-org-edit-right">
                    <table class="table-app">
                        <tr>    
                            <th>Адрес</th>
                            <td><input name="adress" value="<?=$org->adress?>"></td>
                        </tr> 
                        <tr>    
                            <th>Телефон</th>
                            <td><input name="phone"  value="<?=$org->phone?>"></td>
                        </tr> 
                        <tr>    
                            <th>E-mail</th>
                            <td><input name="e_mail" value="<?=$org->e_mail?>"></td>
                        </tr> 
                        <tr>    
                            <th>Контактное лицо</th>
                            <td><input name="fio" value="<?=$org->fio?>"></td>
                        </tr>
                        <tr>    
                            <th>Руководитель</th>
                            <td><input name="manager" value="<?=$org->manager?>"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="add-app-footer  button-group">
                <button type="submit" class="button button-info" name="editOrg">Сохранить</button>
                <a href="<?=url('/web/admin/org/showOrg.php'); ?>" class="link-info">Отменить</a>
            </div>
        </div>    
    </form> 
</div>  
<?php  file_include('/layers/footerAdmin.php'); ?>