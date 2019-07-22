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
$db->close();

file_include('/layers/headerAdmin.php', 'Организации');
?>
<div class="container">
    <div class="add-place">
            <h1>Справочник: Организации</h1>
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th>Организация</th>
                            <td><input  disabled value="<?=$org->name_org?>"></td>    
                        </tr>
                        <tr>
                            <th>УНП</th>
                            <td><input disabled value="<?=$org->ynp?>"></td>
                        </tr>
                        <tr>
                            <th>БИК-Банка</th>
                            <td><input disabled value="<?=$org->bik_bank?>"></td>
                        </tr>
                        <tr>
                            <th>Банк</th>
                            <td><input disabled value="<?=$org->bank?>"></td>
                        </tr>
                        <tr>
                            <th>Расчётный счёт</th>
                            <td><input disabled value="<?=$org->account?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="div-org-edit-right">
                    <table class="table-app">
                        <tr>    
                            <th>Адрес</th>
                            <td><input disabled value="<?=$org->adress?>"></td>
                        </tr> 
                        <tr>    
                            <th>Телефон</th>
                            <td><input disabled value="<?=$org->phone?>"></td>
                        </tr> 
                        <tr>    
                            <th>E-mail</th>
                            <td><input disabled value="<?=$org->e_mail?>"></td>
                        </tr> 
                        <tr>    
                            <th>Контактное лицо</th>
                            <td><input disabled value="<?=$org->fio?>"></td>
                        </tr>
                        <tr>    
                            <th>Руководитель</th>
                            <td><input disabled value="<?=$org->manager?>"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="add-app-footer  button-group">
                <a href="<?=url('/web/admin/org/showOrg.php'); ?>" class="link-info">Отменить</a>
            </div>
    </div>
</div>  
<?php  file_include('/layers/footerAdmin.php'); ?>