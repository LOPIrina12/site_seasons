<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
file_include('/layers/headerAdmin.php', 'Добавить заявку');
access (['admin','user']);
$date_app = date('Y-m-d');

$name_org = '';
$ynp = '';
$adress='';
$phone = '';
$fio = '';
$e_mail = '';
$num_tr_pl = 0;
$size_square=0;
$unit_measure = '';
$rate = 0;
$unit_measure_ = '';

$db = new Db();

$db->setQuery('SELECT `num_app` FROM `application` ORDER BY `num_app` DESC LIMIT 1');
if ($db->getNumRows()) {
    $num_app = $db->getObject(1);
}
$num_app_test = $num_app->num_app;

$db->close();



?>

<div class="container">
    <form method="POST" action="<?=url('/web/admin/app/addApp.php');?>">
        <div class="add-app">
            <div class="div-selector-add">
                <div><h1>Заявка на аренду № <?=$num_app_test + 1?> от  <?=$date_app?>  </h1></div>
                <div class="div-selector">  
                    <select class="select"  name="processed">
                        <option  value="1" <?= ($processed == '1') ? 'selected' : '';?> >Обработано</option>
                        <option  value="0" <?= ($processed == '0') ? 'selected' : '';?> >Не обработано</option>
                    </select>    
                </div>
            </div>  
           
            <div class="div-org-add">
                <div>
                    <table class="table-app">
                        <tr>
                            <th>Организация</th>
                            <td><input type="text" name="num_contract"></td>
                        </tr>
                        <tr>
                            <th>УНП</th>
                            <td><input type="text" name="num_contract"></td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td><input type="text" name="num_contract"></td>
                        </tr>
                    </table>
                </div>
                    <div>
                        <table class="table-app">
                            <tr>
                                <th>Телефон</th>
                                <td><input type="text" name="num_contract"></td>
                            </tr>
                            <tr>
                                <th>Контактное лицо</th>
                                <td><input type="text" name="num_contract"></td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td><input type="text" name="num_contract"></td>
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
                                <td class="table-td-app"><input type="text" name="num_contract"></td>
                                <td class="table-td-app"><input type="text" name="date_contract"></td>
                                <td class="table-td-app"><input type="text" name="date_end_contract"></td>
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
                                <th class="table-th-app">Фото</th>
                                <th class="table-th-app">Статус</th>
                            </tr>
                            <tr>
                                <td class="table-td-app"><input type="text" name="num_contract"></td>
                                <td class="table-td-app"><input type="text" name="date_contract"></td>
                                <td class="table-td-app"><input type="text" name="date_end_contract"></td>
                                <td class="table-td-app"><input type="text" name="num_contract"></td>
                                <td class="table-td-app"><input type="text" name="date_contract"></td>
                                <td class="table-td-app"><input type="text" name="date_end_contract"></td>
                                <td class="table-td-app"><input type="text" name="date_end_contract"></td>
                            </tr>

                        </thead>
                    </table>
                </div>
                <div class="add-app-footer">
                    <button type="submit" class="button-registry">Сохранить</button>
                    <a href="<?=url('/web/admin/dashboard.php'); ?>" >Отменить</a>
                </div>
        </div>    
    </form>    
</div>




<?php  file_include('/layers/footerAdmin.php'); ?>