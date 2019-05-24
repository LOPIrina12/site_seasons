<?php

include '../../library/core.php';

file_include('/library/Db.php');

$name_enterprise = ' ';
$ynp = ' ';
$adress = ' ';
$phone = ' ';
$e_mail = ' ';
$fio = ' ';
$num_app = 0;

$db = new Db();
//variable for id_trading_place chosen from page "Free trading place" by user 

$id ='';
if($_GET['id']) {
    $id= $_GET['id'];
}

if($_POST) {
    if ($_POST['name_enterprise']) {        
        $name_enterprise = $_POST['name_enterprise'];
        $ynp = $_POST['ynp'];
        $adress = $_POST['adress'];
        $phone = $_POST['phone'] ;
        $e_mail = $_POST['e_mail'];
        $fio = $_POST['fio'];
        
        $date_app = date('Y-m-d');
        ++ $num_app;
        $processed = 0;
        //variable for id_trading_place that is gotten from hidden form
        $torg_obj = $_POST['torg_obj'];
      
        $db->setQuery("INSERT INTO `organization`(`name_org`, `ynp`, `adress`, `phone`,`e_mail`, `fio`) 
        VALUES ('$name_enterprise', '$ynp', '$adress', '$phone', '$e_mail','$fio' )");
        
        $id_org = $db->lastId();
       
        $db->setQuery("INSERT INTO `application` (`id_tr_place`,`id_org`,`num_app`, `date_app`, `processed`) 
        VALUES ('$torg_obj','$id_org','$num_app', '$date_app', '$processed')");
        $_SESSION['name_enterprise'] = $name_enterprise;
        $_SESSION['ynp'] = $ynp;
        $_SESSION['adress'] = $adress;
        $_SESSION['phone'] = $phone;
        $_SESSION['e_mail'] = $e_mail;
        $_SESSION['fio'] = $fio;
        
    }
}
$db->close();

file_include('/layers/header.php', 'Заявка на аренду');

?>

    <div class="content">
      <div class="container">
        <div class="arenda">
        <h1>Заявка на аренду</h1>
          <form action="<?=url('/web/application/applicationRent.php');?>" method="POST" >
               <div class="form-row">
                            <div class="form-col-left"></div>
                            <div class="form-col-right">
                                <p>Поля, отмеченные звездочкой, обязательны для заполнения.<p>
                            </div>
                </div>
                <?php if($id): ?>
                    <input type="hidden" name="torg_obj" value="<?= $id; ?>">
                <?php endif; ?>
                <div class="form-row">
                            <div class="form-col-left">
                            <label for="name_enterprise" class="label-required">Название организации</label>
                            </div>
                            <div class="form-col-right">
                                <input type="text" name="name_enterprise">
                            </div>
                            
                </div> 
            
                <div class="form-row">
                           
                            <div class="form-col-left">
                            <label for="ynp" class="label-required">УНП</label>
                            </div>
                            <div class="form-col-right">
                                <input type="text" name="ynp" id="ynp">
                            </div>
                            
                </div> 
                
                <div class="form-row">
                           
                            <div class="form-col-left">
                            <label for="adress" class="label-required">Адрес</label>
                            </div>
                            <div class="form-col-right">
                                <input type="text" name="adress" id="adress">
                            </div>
                            
                </div> 
                
                  <div class="form-row">
                           
                            <div class="form-col-left">
                            <label for="adress" class="label-required">Телефон</label>
                            </div>
                            <div class="form-col-right">
                                <input type="text" name="phone" id="phone">
                            </div>
                            
                </div> 
                
                 <div class="form-row">
                           
                            <div class="form-col-left">
                            <label for="e-mail" class="label-required">Почтовый ящик</label>
                            </div>
                            <div class="form-col-right">
                                <input type="text" name="e_mail" id="e-mail">
                            </div>
                            
                </div> 
                
                <div class="form-row">
                           
                            <div class="form-col-left">
                            <label for="fio" class="label-required">Контактное лицо</label>
                            </div>
                            <div class="form-col-right">
                                <input type="text" name="fio" id="fio">
                            </div>
                            
                </div> 
               
               <div class="div-button-submit" >
                    <button type="submit" class="button-submit">Отправить</button> 
               </div>
                    

          </form>
        
        </div>
       
        </div>

      </div>

    </div>


<?php file_include ('/layers/footer.php');?>