<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

$id ='';
if ($_GET['id_tradingPlace']) {

    $id=$_GET['id_tradingPlace'];
}




file_include('/layers/headerAdmin.php', 'Торговые места');
?>

<div class="container">
    
    <form method="POST" action="<?=url('/web/admin/tradingPlace/addTrPlace.php');?>">
        <div class="add-place">
            <h1>Справочник: Торговые места</h1>
           
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th>Номер торгового места</th>
                            <td><input name="number_place" disabled>
                            </td>    
                        </tr>
                        <tr>
                            <th>Этаж</th>
                            <td><input name="floor" disabled>
                        </tr>
                        <tr>
                            <th>Площадь, м2</th>
                            <td><input name="size_square"></td>
                        </tr>
                        <tr>
                            <th>Стоимость 1 м2, $</th>
                            <td><input name="rate"></td>
                        </tr>
                        <tr>
                            <th>Фотография</th>
                            <td>
                                <label for="add-file" class="upload">
                                    <input type="file" name="image" id="add-file">
                                    <div class="button button-primary">Редактировать файл</div>
                                </label>
                            </td>    
                        </tr>
                    </table>
                </div>
                <div class="div-org-edit-right">
                    <table class="table-app">
                        <tr>
                            <th>Статус</th>
                            <td>
                                <select class="select">
                                    <option  value="1" <?= ($rented == '1') ? 'selected' : '';?> >Арендовано</option>
                                    <option  value="0" <?= ($rented == '0') ? 'selected' : '';?> >Не арендовано</option>
                                </select>
                            </td>
                        </tr>
                        <tr>    
                            <th>Договор аренды</th>
                            <td><input type="text" name="num_contract"></td>
                        </tr> 
                        <tr>    
                            <th>Дата заключения договора</th>
                            <td><input type="date" name="date_contract"></td>
                        </tr> 
                        <tr>    
                            <th>Начало аренды</th>
                            <td><input type="date" name="begin_arenda"></td>
                        </tr>
                        <tr>    
                            <th>Окончание аренды</th>
                            <td><input type="date" name="end_arenda"></td>
                        </tr>      
                    </table>
                </div>
            </div>
            <div class="add-app-footer  button-group">
                <button type="submit" class="button button-info" name="addPlace">Сохранить</button>
                <a href="<?=url('/web/admin/tradingPlace/showTrPlace.php'); ?>" class="link-info">Отменить</a>
            </div>
        </div>
    </form>
</div>


<?php  file_include('/layers/footerAdmin.php'); ?>