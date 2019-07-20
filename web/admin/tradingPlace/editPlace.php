<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

$id ='';
if ($_GET['id_tradingPlace']) {

    $id=$_GET['id_tradingPlace'];
}

$image='';
$id_img='';
if ($_GET['id_tradingPlace'] && $_GET['image']) {
    $id_img=$_GET['id_tradingPlace'];
    $image=$_GET['image'];
}

$db = new Db();
$db->setQuery ("SELECT * FROM `tradingPlace` WHERE `id_tradingPlace` = '$id'");
$place = NULL;
if ($db->getNumRows ()){
    $place = $db -> getObject(1);
}

$db->setQuery ("UPDATE `tradingPlace` SET `image`='$image' WHERE `id_tradingPlace` = '$id_img'");
//header("Refresh:5");

if ($_POST){
    // echo '<pre>';
    // var_dump ($_POST);
    // echo '</pre>';
    
    if ($_POST['id_tradingPlace'] || $_POST['size_square'] || $_POST['rate']|| $_POST['rented']) {
        $id = $_POST['id_tradingPlace'];
        $size_square = $_POST['size_square'];
        $rate = $_POST['rate'];
        $rented = $_POST['rented'];
        $db->setQuery ("UPDATE `tradingPlace` 
                        SET `size_square`='$size_square',`rate`='$rate', `rented`='$rented'
                        WHERE `id_tradingPlace` = '$id'");
    }
    header('Location: ' . url('/web/admin/tradingPlace/showTrPlace.php'));
}



$db->close();


file_include('/layers/headerAdmin.php', 'Торговые места');
?>

<div class="container">
    <form method="POST" action="<?=url('/web/admin/tradingPlace/editPlace.php');?>">
        <div class="add-place">
            <h1>Торговое место № <?= $place->number_place?></h1>
            <h2>Этаж <?=$place->floor?></h2>
            
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table  class="table-app">
                        <tr align="center"> 
                            <img width="350px" height="300px" 
                            src="<?= url('/assets/img/tradingPlace/') . $place->image;?>">    
                        </tr>
                    </table>
                </div>
                <div class="div-org-edit-right">
                   <table class="table-app">
                        <tr>
                            <th>Фотография</th>
                            <td>
                                <label for="add-file" class="upload">
                                    <input type="file" name="image" id="add-file" onchange="test()">
                                    <div class="button button-primary">Выбрать изображение</div>
                                </label>
                            </td>
                            <td>
                                <div id="reload" class="button button-primary" onclick="reload()">Обновить</div>
                            </td> 
                        </tr>
                        <tr>
                            <th>Площадь, м2</th>
                            <td><input name="size_square" value="<?= $place->size_square?>"></td>
                        </tr>
                        <tr>
                            <th>Стоимость 1 м2, $</th>
                            <td><input name="rate" value="<?=$place->rate?>"></td>
                        </tr>
                        <tr>
                            <th>Статус</th>
                            <td>
                                <?php if ($place->rented === '1'):?>
                                <select class="select" name="rented">
                                    <option  value="1" <?= ($rented == '1') ? 'selected' : '';?> >Арендовано</option>
                                    <option  value="0" <?= ($rented == '0') ? 'selected' : '';?> >Не арендовано</option>
                                </select>
                                <? else :?>
                                <select class="select" name="rented">
                                    <option  value="0" <?= ($rented == '0') ? 'selected' : '';?> >Не арендовано</option>
                                    <option  value="1" <?= ($rented == '1') ? 'selected' : '';?> >Арендовано</option>
                                </select>
                                <? endif;?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div><input type="hidden" name="id_tradingPlace" value="<?=$place->id_tradingPlace?>"></div>
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
   function test(){
       let file = document.getElementById('add-file');
       let image = file.files.item(0).name;
       console.log (image);
       // let fileArray = test.split('/');
       // console.log (fileArray);
       let query ='&image=' + image;
       let location = '/web/admin/tradingPlace/editPlace.php?id_tradingPlace=1'+query;
       document.location.href = location;
   }
   function reload(){
       window.location.reload();
   }
    
</script>



