<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

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
$processed = '';
if ($_POST) {
    if ($_POST['processed'] && $_POST['num_app'] ) {
        $processed = $_POST['processed'];
        $num_app = $_POST['num_app'];
              if ($processed === 'false' ){
                $db->setQuery ("UPDATE `application` SET `processed`= '0'  WHERE  `num_app`='$num_app'");
              }
              else {
                $db->setQuery ("UPDATE `application` SET `processed`= '1'  WHERE  `num_app`='$num_app'");
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
                            <option  value="true" <?= ($processed == 'true') ? 'selected' : '';?> >Обработано</option>
                            <option  value="false" <?= ($processed == 'false') ? 'selected' : '';?> >Не обработано</option>
                        </select>    
                    </div>
                </div> 
                <div class="div-org-add">
                    <div class="div-org-edit-left">
                        <table class="table-app">
                           <tr>
                               <th>Организация</th>
                               <td><input readonly id="name_org" type = "text" name="name_org" value="<?=$app->name_org?>"></td>
                           </tr>
                           <tr>
                               <th>УНП</th>
                               <td><input readonly id="ynp" type="text" name="ynp" value="<?=$app->ynp?>"></td>
                           </tr>
                           <tr>
                               <th>Адрес</th>
                               <td><input readonly id="adress" type="text" name="adress" value="<?=$app->adress?>"></td>
                           </tr>
                        </table>
                    </div>
                    <div class="div-org-edit-right">
                        <table class="table-app">
                            <tr>
                                <th>Телефон</th>
                                <td><input readonly value="<?=$app->phone?>"></td>
                            </tr>
                            <tr>
                                <th>Контактное лицо</th>
                                <td><input readonly value="<?=$app->fio?>"></td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td><input readonly value="<?=$app->e_mail?>"></td>
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
                                <td class="table-td-app"><input type="text" name="num_contract"
                                    value="<?=$app->num_contract?>"></td>
                                <td class="table-td-app"><input type="text" name="date_contract"
                                    value="<?=$app->date_contract?>"></td>
                                <td class="table-td-app"><input type="text" name="date_end_contract"
                                    value="<?=$app->date_end_contract?>"></td>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div >
                    <table class="table-app">
                            <thead>
                                <tr>
                                    <th class="table-th-app">Номер т.м.</th>
                                    <th class="table-th-app">Площадь</th>
                                    <th class="table-th-app">Ед.изм.</th>
                                    <th class="table-th-app">Ставка</th>
                                    <th class="table-th-app">Ед.изм.</th>
                                    <th class="table-th-app">Статус</th>
                                </tr>
                                <tr>
                                    <td class="table-td-app"><input type="text" 
                                    name="number_place" value="<?=$app->number_place?>"></td>
                                    <td class="table-td-app"><input type="text" 
                                    name="size_square" value="<?=$app->size_square?>"></td>
                                    <td class="table-td-app"><input type="text" 
                                    name="unit_measure" value="<?=$app->unit_measure?>"></td>
                                    <td class="table-td-app"><input type="text"
                                    name="rate" value="<?=$app->rate?>"></td>
                                    <td class="table-td-app"><input type="text" 
                                    name="unit_measure_" value="<?=$app->unit_measure_?>"></td>

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