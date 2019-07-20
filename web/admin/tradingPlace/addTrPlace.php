<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
if ($_GET['id_org']){
    $id_org=$_GET['id_org'];
}

$db = new Db();

$db->setQuery('SELECT `id`,`name_org` FROM `organization` ORDER BY `name_org`');
if($db->getNumRows()) {
    $orgs = $db->getObject();
}

if($_POST) {
    if($_POST['number_place']) {
        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';
           $number_place = $_POST['number_place'];
           $floor = $_POST['floor'];
           $size_square = $_POST['size_square'];
           $rate= $_POST ['rate'];
           $unit_measure = 'м2';
           $unit_measure_ = '$';
           $image = $_POST['image'];
           $rented = '0';

           $db->setQuery("SELECT `number_place` FROM `tradingPlace` 
           WHERE `number_place` = '$number_place' LIMIT 1");
           if ($db->getNumRows()) {
               $error_place = "Торговое место уже существует!";
           } else {
                $db->setQuery ("INSERT INTO `tradingPlace`
                                (`number_place`,`floor`,`size_square`,`rate`,
                                `rented`,`unit_measure`,`unit_measure_`,`image`) 
                                VALUES ('$number_place', '$floor','$size_square','$rate','$rented',
                                '$unit_measure','$unit_measure_', '$image')");   
                header('Location: ' . url('/web/admin/tradingPlace/showTrPlace.php')); 
            }  
    } else {
        $error_enterPlace = "Введите номер торгового места";
    }
}


$db->close();

file_include('/layers/headerAdmin.php', 'Добавить торговое место');
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
                            <td><input name="number_place">
                                <?php if ($error_place) :?>
                                <p style="width:100%; margin:0; color: #DD0000"><?=$error_place?></p>
                                <?php endif;?> 
                                <?php if($error_enterPlace): ?>
                                <p style="width:100%; margin:0; color: #DD0000"><?= $error_enterPlace . ' !'; ?></p>
                                <?php endif; ?>
                            </td>    
                        </tr>
                        <tr>
                            <th>Этаж</th>
                            <td><input name="floor">
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
                                    <div class="button button-primary">Добавить файл</div>
                                </label>
                            </td>    
                        </tr>
                    </table>
                </div>
                <div class="div-org-edit-right">
                    <table class="table-app">     
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

