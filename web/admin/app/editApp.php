<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);


$num_app ='';
if($_GET['num_app']) {
   $num_app=$_GET['num_app'];
}
$db = new Db();
$db->setQuery("SELECT `a`.`id_org`,`a`.`id_tr_place`, `a`.`num_app`,`a`.`date_app`,`a`.`num_contract`,
`a`.`date_contract`,`a`.`date_end_contract`,`a`.`processed`,
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
$num_contract_last = '';
$db->setQuery("SELECT `num_contract` FROM `application` ORDER BY `num_contract` DESC LIMIT 1");
if ($db->getNumRows()){
    $num_contract_last=$db->getObject(1)->num_contract;
} 

$processed = '';


if ($_POST) {
  /* dump($_POST);*/
    if ($_POST['processed'] && $_POST['num_app']
    && $_POST['num_contract'] && $_POST['date_contract'] && $_POST['date_end_contract']) {
        $processed = $_POST['processed'];
        $num_app = $_POST['num_app'];
        $num_contract = $_POST ['num_contract'];
        $date_contract = $_POST ['date_contract'];
        $date_end_contract = $_POST['date_end_contract'];
        $date=date("Y-m-d",strtotime($date_contract));
            if ($processed === "true") {
                $db->setQuery ("UPDATE `application` 
                SET `processed`= '1' ,`num_contract`='$num_contract',
                `date_contract`='$date', `date_end_contract`='$date_end_contract'
                WHERE  `num_app`='$num_app'");
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
                        <h1>Заявка на аренду № <?=$num_app?> от <?=$app->date_app;?> </h1>
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
                                <th class="table-th-app">Дата окончания договора</th>
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
                                <input type="date" value="<?=$app->date_end_contract?>" name="date_end_contract">
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
                                    <td class="table-td-app"><input  type="text" 
                                    name="number_place" value="<?=$app->number_place?>" disabled></td>
                                    <td class="table-td-app"><input  type="text" 
                                    name="size_square" value="<?=$app->size_square?>" disabled></td>
                                    <td class="table-td-app"><input type="text"
                                    name="rate" value="<?=$app->rate?>" disabled></td>
                                    <td class="table-td-app"><div class="div-selector">  
                        <select class="select"  name="rented">
                            <option  value="true" <?= ($rented == 'true') ? 'selected' : '';?> >Арендовано</option>
                            <option  value="false" <?= ($rented == 'false') ? 'selected' : '';?> >Не арендовано</option>
                        </select>    
                    </div>
                                    
                                    </td>
                                </tr>
                            </thead>
                    </table>
                </div>
                <div class="add-app-footer">
                    <button type="submit" class="button-registry" name="edit">Обновить</button>
                    <a href="<?=url('/web/admin/dashboard.php'); ?>" >Отменить</a>
                   
                </div>
                
            </div>    
    </form> 
</div>

<?php  file_include('/layers/footerAdmin.php'); ?>

<script type="text/javascript"> 

/*
$('.button-registry').click(function(e){
    e.preventDefault();
    var name_org = "name=" + $('#name_org').val();
        $.ajax({
            url: "/web/admin/ajax/test.php",
            type: "POST",
            data: {data: $('#form-edit').serialize()},
                success: function(data){
                        
                        $('#name_org').html(data);
                }
        });
});*/

/*
$(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name').val(data.name);  
                     $('#address').val(data.address);  
                     $('#gender').val(data.gender);  
                     $('#designation').val(data.designation);  
                     $('#age').val(data.age);  
                     $('#employee_id').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
*/
</script>