<?php
include '../../../library/core.php';
file_include('/library/Db.php');

access (['admin','user']);
if ($_GET['id'] || $_GET['name_org']){
    $id=$_GET['id'];
    $name_org=$_GET['name_org'];
}

$db = new Db();

$db->setQuery('SELECT `num_app` FROM `application` ORDER BY `num_app` DESC LIMIT 1');
if ($db->getNumRows()) {
    $num_app = $db->getObject(1);
}
$num_app_test = $num_app->num_app;

$db->setQuery('SELECT `id`,`name_org` FROM `organization` ORDER BY `name_org`');
if($db->getNumRows()) {
    $orgs = $db->getObject();
}

$db->setQuery("SELECT * FROM `organization` WHERE `id`='$id' LIMIT 1");
if($db->getNumRows()){
    $organization= $db->getObject(1);
}
$tradingPlaces = NULL;
$db->setQuery("SELECT * FROM `tradingPlace` WHERE `rented`='0' ORDER BY `number_place`");
if($db->getNumRows()) {
    $tradingPlaces = $db->getObject();
} 

$id_tr_place = '';
$id_org='';
$num_app='';
$date_app='';
$begin_arenda='';
$end_arenda='';
$processed = 0;
$rented='';

if($_POST) {
   
    if ($_POST['id_tr_place'] && $_POST['id_org'] && $_POST['num_app'] && $_POST['date_app']
    && $_POST['begin_arenda'] && $_POST['end_arenda'] && $_POST['rented']) {
        $id_tr_place = $_POST['id_tr_place'];
        $id_org= $_POST['id_org'] ;
        $num_app= $_POST['num_app'];
        $date_app= $_POST['date_app'];
        $begin_arenda= $_POST['begin_arenda'];
        $end_arenda= $_POST['end_arenda'] ;
        $processed = 0;
        $rented= $_POST['rented'];  
        $db->setQuery ("INSERT INTO `application` (`id_tr_place`,`id_org`,`num_app`,`date_app`,
                        `begin_arenda`,`end_arenda`,`processed`) 
                        VALUES ('$id_tr_place','$id_org','$num_app','$date_app','$begin_arenda',
                        ' $end_arenda','$processed')");
       $db->setQuery ("UPDATE `tradingPlace`
                       SET `rented` = '$rented'
                       WHERE `id_tradingPlace` = '$id_tr_place'");    
        
        header('Location: ' . url('/web/admin'));
    }
}
$db->close();
$date_app = date('Y-m-d');
file_include('/layers/headerAdmin.php', 'Добавить заявку');

?>

<div class="container">
    <form method="POST" action="<?=url('/web/admin/app/addApp.php');?>">
        <div class="add-app">
            <div class="div-selector-add">
                <div class="title-form">
                    <div><h1>Заявка на аренду №    </h1></div>
                    <div><input class="input-num" name="num_app" value="<?=$num_app_test + 1?>"></div>
                    <div><h1>  от  </h1></div>
                    <div><input class="input-date" name="date_app" type="date" value="<?=$date_app?>"></div>
                </div>
               <!-- <div class="div-selector">  
                    <select class="select"  name="processed">
                        <option  value="0" <?= ($processed == '0') ? 'selected' : '';?> >
                        Не обработано</option>
                        <option  value="1" <?= ($processed == '1') ? 'selected' : '';?> >
                        Обработано</option> 
                    </select>    
                </div>-->
            </div> 
            <div class="div-org-add">
                <div class="div-org-edit-left">
                    <table class="table-app">
                        <tr>
                            <th>Организация</th>
                            <td>
                                <select id="select" class="select"  name="id_org" onchange="select_org()">
                                    <option value='0'>Выберите из списка</option>
                                    <?php foreach ($orgs as $org): ?>
                                        <option value="<?=$org->id ;?>"
                                         <?=($id == $org->id) ? 'selected' : '';?> >
                                        <?=$org->name_org ;?>
                                        </option>        
                                    <?php endforeach; ?> 
                                </select>  
                            </td>
                        </tr>
                        <tr>
                            <th>УНП</th>
                            <td><input type="text" name="ynp" value="<?=$organization->ynp?>"> </td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td><input type="text" name="adress" value="<?=$organization->adress?>" ></td>
                        </tr>
                    </table>
                </div>
                    <div class="div-org-edit-right">
                        <table class="table-app">
                            <tr>
                                <th>Телефон</th>
                                <td><input type="text" name="phone" value="<?=$organization->phone?>"></td>
                            </tr>
                            <tr>
                                <th>Контактное лицо</th>
                                <td><input type="text" name="fio" value="<?=$organization->fio?>"></td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td><input type="text" name="e_mail" value="<?=$organization->e_mail?>"></td>
                            </tr>   
                        </table>
                    </div>
                </div>
                <div >
                <table class="table-app">
                        <thead>
                            <tr>
                                <th class="table-th-app">Номер т.м.</th>
                                <th class="table-th-app">Начало аренды</th>
                                <th class="table-th-app">Окончание аренды</th>
                                <th class="table-th-app">Статус</th>
                            </tr>
                            <tr>
                                <td class="table-td-app">
                                    <select id="selectedPlace" class="select"  name="id_tr_place" onchange="">
                                        <option value='0'>Выберите из списка</option>
                                        <?php foreach ($tradingPlaces as $place): ?>
                                        <option value="<?=$place->id_tradingPlace ;?>" <?=($id == $place->id_tradingPlace) ? 'selected' : '';?> >
                                        <?=$place->number_place ;?>
                                        </option>        
                                        <?php endforeach; ?> 
                                    </select>  
                                </td>
                                <td class="table-td-app"><input type="date" name="begin_arenda"></td>
                                <td class="table-td-app"><input type="date" name="end_arenda"></td>
                                <td class="table-td-app">
                                    <div class="div-selector">  
                                        <select class="select"  name="rented">
                                            <option  value="0" <?= ($rented == '0') ? 'selected' : '';?> >
                                            Не арендовано</option>
                                            <option  value="1" <?= ($rented == '1') ? 'selected' : '';?> >
                                            Арендовано</option>
                                        </select>    
                                    </div>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="add-app-footer  button-group">
                    <button type="submit" class="button button-info" name="edit">Сохранить</button>
                    <a href="<?=url('/web/admin'); ?>" class="link-info">Отменить</a>
                </div>
        </div>    
    </form>   
</div>
<?php  file_include('/layers/footerAdmin.php'); ?>
<script>
    function select_org() {
        let select_field = document.getElementById('select');
        let id = select_field.value;
        let name_org = select_field.options[document.getElementById('select').selectedIndex].text;
        console.log (id);
        console.log (name_org);
        let query ='&id=' + id;
        let loc = '/web/admin/app/addApp.php?query' + query;
        document.location.href = loc;
    }

    function select_place() {
        let selected_field = document.getElementById('selectedPlace');
        console.log (selected_field);
        let id_place = selected_field.value;
        console.log (id_place);
       let loc = 'http://seasons/web/admin/app/addApp.php?id_place='+ id_place;
        document.location.href = loc;
    }

</script>




