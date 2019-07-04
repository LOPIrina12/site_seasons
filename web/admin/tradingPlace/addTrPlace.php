<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);
if ($_GET['id_org']){
    $id_org=$_GET['id_org'];
}

echo $id_org;

$db = new Db();

$db->setQuery('SELECT `id`,`name_org` FROM `organization` ORDER BY `name_org`');
if($db->getNumRows()) {
    $orgs = $db->getObject();
}

if($_POST) {
    if($_POST['number_place']) {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        echo $id_org;
           $number_place = $_POST['number_place'];
           $floor = $_POST['floor'];
           $size_square = $_POST['size_square'];
           $rate= $_POST ['rate'];
           $unit_measure = 'м2';
           $unit_measure_ = '$';
           $image = $_POST['image'];
           $rented = $_POST['rented'];
           $id_org=$_POST['id_org'];
           $num_contract=$_POST['num_contract'];
           $date_contract=$_POST['date_contract'];
           $begin_arenda=$_POST['begin_arenda'];
           $end_arenda=$_POST['end_arenda'];

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
                if ($rented === '1') {
                    $db->setQuery ("SELECT `id_tradingPlace` FROM `tradingPlace` ORDER BY `id_tradingPlace`
                                    DESC LIMIT 1");
                    if ($db->getNumRows ()){
                        $id = $db->getObject(1);
                    }
                    $id_tradingPlace=$id->id_tradingPlace;         
                }                 
                    $db->setQuery ("INSERT INTO `contract`
                                (`id_tr_place`,`num_contract`, `date_contract`,`begin_arenda`, `end_arenda`) 
                                VALUES ('$id_tradingPlace','$num_contract', 
                                '$date_contract','$begin_arenda','$end_arenda')");
                    
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
                            <th>Статус</th>
                            <td>
                                <select class="select" name="rented">
                                    <option  value="1" <?= ($rented == '1') ? 'selected' : '';?> >Арендовано</option>
                                    <option  value="0" <?= ($rented == '0') ? 'selected' : '';?> >Не арендовано</option>
                                </select>
                            </td>
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
                        
                        <tr>    
                            <th>Организация</th>
                            <td>
                            
                            
                            <select id="select" class="select"  name="id_org" onchange="select_org()">
                                <option value='0'>Выберите из списка</option>
                                    <?php foreach ($orgs as $org): ?>
                                <option value="<?=$org->id ;?>"
                                    <?=($id_org == $org->id) ? 'selected' : '';?> >
                                    <?=$org->name_org ;?>
                                </option>        
                                    <?php endforeach; ?> 
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

<script>
    function select_org() {
        console.log ("hello");
        let select_field = document.getElementById('select');
        console.log(select_field);
        let id_org = select_field.value;
        
        console.log (id_org);
      
    
        let loc = '/web/admin/tradingPlace/addTrPlace.php?id_org=' + id_org;
        document.location.href = loc;
    }

</script>
