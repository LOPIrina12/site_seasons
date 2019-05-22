<?php

 include '../../library/core.php';


 file_include('/library/Db.php');

$name_enterprise = ' ';
/*$ynp = ' ';
$adress = ' ';
$phone = ' ';
$e_mail = ' ';
$fio = ' ';
$trading_profile = ' ';*/
$db = new Db();

if($_GET) {
    if ($_GET['name_enterprise']/* && $_POST['ynp'] && $_POST['adress'] &&
    $_POST['phone'] && $_POST['e_mail'] && $_POST['fio'] && $_POST['trading_profile']*/) {
        $name_enterprise = $_GET['name_enterprise'];
        echo $name_enterprise;
        die();
       /* $ynp = $_POST['ynp'];
        $adress = $_POST['adress'];
        $phone = $_POST['phone'] ;
        $e_mail = $_POST['e_mail'];
        $fio = $_POST['fio'];
        $trading_profile = $_POST['trading_profile'];*/
        /*$db->setQuery("INSERT INTO `application` (`name_enterprise`) VALUES ('$name_enterprise ')");
        $_SESSION['name_enterprise'] = $name_enterprise;*/
   
    }
    
}
$db->close();


file_include('/layers/header.php', 'Заявка на аренду');

?>

<div class="content">
  <div class="container">
    <div class="arenda">
    <h1>Заявка на аренду</h1>
      <form action="<?=url('/web/application/applicationRent.php');?>" method="GET" >
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
                            <input type="text" name="name_enterprise" id="name_enterprise">
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
                        <label for="e-mail" class="label-required">Почтовый ящик</label>
                        </div>
                        <div class="form-col-right">
                            <input type="text" name="e-mail" id="e-mail">
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