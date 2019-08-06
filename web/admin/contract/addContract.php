<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

if ($_GET['id']){
    $id=$_GET['id'];
}

$db = new Db();

$db->setQuery("SELECT `id`,`num_contract` FROM `contract` ORDER BY `id` DESC LIMIT 1 ");
if ($db->getNumRows()) {
    $num_contract = $db->getObject(1);
}

$num_contractForView= $num_contract->num_contract;

$db->setQuery('SELECT `id`,`name_org` FROM `organization` ORDER BY `name_org`');
if($db->getNumRows()) {
    $orgs = $db->getObject();
}

$db->setQuery("SELECT * FROM `organization` WHERE `id`='$id' LIMIT 1");
if($db->getNumRows()){
    $organization= $db->getObject(1);
}
$tradingPlaces = NULL;
$db->setQuery("SELECT * FROM `tradingPlace` ");
if($db->getNumRows()) {
    $tradingPlaces = $db->getObject();
} 

if($_POST) {
   
    if ($_POST['id_tr_place'] && $_POST['id_org'] && $_POST['num_contract'] && $_POST['date_contract']
    && $_POST['begin_arenda'] && $_POST['end_arenda'] && $_POST['status']) {
        $id_tr_place = $_POST['id_tr_place'];
        $id_org= $_POST['id_org'] ;
        $num_contract= $_POST['num_contract'];
        $date_contract= $_POST['date_contract'];
        $begin_arenda= $_POST['begin_arenda'];
        $end_arenda= $_POST['end_arenda'] ;
        $status= $_POST['status'];  
        $db->setQuery ("INSERT INTO `contract` (`id_tr_place`,`id_org`,`num_contract`,`date_contract`,
                        `begin_arenda`,`end_arenda`,`status`) 
                        VALUES ('$id_tr_place','$id_org','$num_contract','$date_contract','$begin_arenda',
                        ' $end_arenda','$status')");
        $db->setQuery ("UPDATE `tradingPlace`
                       SET `rented` = '1'
                       WHERE `id_tradingPlace` = '$id_tr_place'");    
    }
    header('Location: ' . url('/web/admin/contract/showContract.php'));
}

$db->close();
$date = date('Y-m-d');

file_include('/layers/headerAdmin.php', 'Добавить контракт');
?>


<div class="container">
    <form method="POST" action="<?=url('/web/admin/contract/addContract.php');?>">
        <div class="add-app">
            <div class="div-selector-add">
                <div class="title-form">
                    <div><h1>Договор №    </h1></div>
                    <div><input class="input-num" name="num_contract" 
                                placeholder="<?=$num_contractForView?> "value=""></div>
                    <div><h1>  от  </h1></div>
                    <div><input class="input-date" name="date_contract" type="date" value="<?= $date?>"></div>
                </div>
               <div class="div-selector">  
                    <select class="select"  name="status">
                        <option  value="1" <?= ($status == '1') ? 'selected' : '';?> >
                        Действующий</option> 
                        <option  value="0" <?= ($status == '0') ? 'selected' : '';?> >
                        Не действующий</option>
                    </select>    
                </div>
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
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="add-app-footer  button-group">
                    <button type="submit" class="button button-info" name="addContract">Сохранить</button>
                    <a href="<?=url('/web/admin/contract/showContract.php'); ?>" class="link-info">Отменить</a>
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
        let loc = '/web/admin/contract/addContract.php?query' + query;
        document.location.href = loc;
    }
</script>



<?php  file_include('/layers/footerAdmin.php'); ?>