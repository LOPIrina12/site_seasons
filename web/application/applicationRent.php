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
        
        $id_org = $db->setQuery("SELECT `id` FROM `organization` ORDER BY `id` DESC LIMIT 1");
      
        echo $id_org;
     
        $db->setQuery("INSERT INTO `application` (`id_org`,`num_app`, `date_app`, `processed`) 
        VALUES ('$id_org','$num_app', '$date_app', '$processed')");
        
        $db->setQuery("INSERT INTO `organization`(`name_org`, `ynp`, `adress`, `phone`,`e_mail`, `fio`) 
        VALUES ('$name_enterprise', '$ynp', '$adress', '$phone', '$e_mail','$fio' )");
        
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