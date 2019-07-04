<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
$db = new Db();
if ($_POST) {
    if ($_POST['name_org'] && $_POST['ynp'] && $_POST['bik_bank']
    && $_POST['bank'] && $_POST['account'] && $_POST['adress']
    && $_POST['phone'] && $_POST['e_mail'] && $_POST['fio']) {
        $name_org = $_POST['name_org'];
        $ynp = $_POST['ynp'];
        $bik_bank = $_POST['bik_bank'];
        $bank = $_POST['bank'];
        $account = $_POST['account'];
        $adress = $_POST['adress'];
        $phone = $_POST['phone'];
        $e_mail = $_POST['e_mail'];
        $fio = $_POST['fio'];

        $db->setQuery ("INSERT INTO `organization`
                      (`name_org`, `ynp`, `bik_bank`, `bank`, `account`,
                       `adress`, `phone`, `e_mail`, `fio`)
                      VALUES ('$name_org','$ynp','$bik_bank','$bank','$account',
                      '$adress','$phone','$e_mail','$fio')");
        header('Location: ' . url('/web/admin/щкп/showOrg.php')); 
       
    } else {
        $error = "Заполнены не все поля!";
    }
}
$db->close();



file_include('/layers/headerAdmin.php', 'Добавить организацию');
?>

<div class="container">
    
    <form method="POST" action="<?=url('/web/admin/org/addOrg.php');?>">
        <div class="add-place">
            <h1>Справочник: Организации</h1>
            <div class="form-col-right">
                <p>* Поля, отмеченные звездочкой, обязательны для заполнения.<p>
            </div>
            <?php if ($error):?>
            <p style="width:100%; margin:0; color: #DD0000"><?=$error;?></p>
            <?php endif;?>
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th><label class="label-required" for="name_org">Организация</label></th>
                            <td><input name="name_org"  placeholder=""  ></td>    
                        </tr>
                        <tr>
                            <th><label class="label-required" for="ynp">УНП</label></th>
                            <td><input name="ynp" placeholder = "" ></td>
                        </tr>
                        <tr>
                            <th><label class="label-required" for="bik_bank">БИК-Банка</label></th>
                            <td><input name="bik_bank" ></td>
                        </tr>
                        <tr>
                            <th><label class="label-required" for="bank">Банк</label></th>
                            <td><input name="bank" ></td>
                        </tr>
                        <tr>
                            <th><label class="label-required" for="account">Расчётный счёт</label></th>
                            <td><input name="account" ></td>
                        </tr>
                    </table>
                </div>
                <div class="div-org-edit-right">
                    <table class="table-app">
                        <tr>    
                            <th><label class="label-required" for="adress">Адрес</label></th>
                            <td><input name="adress" ></td>
                        </tr> 
                        <tr>    
                            <th><label class="label-required" for="adress">Телефон</label></th>
                            <td><input type="text" name="phone" ></td>
                        </tr> 
                        <tr>    
                            <th><label class="label-required" for="e_mail">E-mail</label></th>
                            <td><input type="text" name="e_mail" ></td>
                        </tr> 
                        <tr>    
                            <th><label class="label-required" for="fio">Контактное лицо</label></th>
                            <td><input type="text" name="fio" ></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="add-app-footer  button-group">
                <button type="submit" class="button button-info" name="addOrg">Сохранить</button>
                <a href="<?=url('/web/admin/org/showOrg.php'); ?>" class="link-info">Отменить</a>
            </div>
        </div>
    </form>
    
</div>


<?php  file_include('/layers/footerAdmin.php'); ?>