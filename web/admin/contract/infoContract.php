<?php
include '../../../library/core.php';
file_include('/library/Db.php');
access (['admin','user']);

file_include('/layers/headerAdmin.php', 'Просмотр контракта');
?>

<div class="container">
    <h1>Договор № </h1>
    <div class="info">
                    
                </div> 
    <div class="add-place">
        <div class="div-org-add">
                    <div class="div-org-edit-left">
                        <table class="table-app">
                           <tr>
                               <th>Организация</th>
                               <td></td>
                           </tr>
                           <tr>
                               <th>Площадь, м2</th>
                               <td><?=$place->size_square?></td>
                           </tr>
                           <tr>
                               <th>Ставка, $</th>
                               <td><?=$place->rate?></td>
                           </tr>
                           <tr>
                               <th>Статус</th>
                               <?php if( $place->rented === '1'):?>
                               <td>Арендовано</td>
                               <?php else :?>
                               <td>Не арендовано</td>
                               <?php endif ;?>
                           </tr>
                           <tr>
                                <th>Договор</th>
                                <?php if( $place->rented === '1'):?>
                                <td><?=' № '. $place->num_contract. ' от '. $date_contractForView?></td>
                                <?php else:?>
                                <td><?=''?></td>
                                <?php endif ;?>
                           </tr>
                           <tr>
                                <th>Начало аренды</th>
                                <?php if( $place->rented === '1'):?>
                                <td><?=$begin_arendaForView?></td>
                                <?php else:?>
                                <td><?= ' '?></td>
                                <?php endif ;?>
                               
                           </tr>
                           <tr>
                                <th>Окончание аренды</th>
                                <?php if( $place->rented === '1'):?>
                                <td><?=$end_arendaForView?></td>
                                <?php else:?>
                                <td><?= ' '?></td>
                                <?php endif ;?>
                               
                           </tr>
                        </table>
                    </div>
                    <div class="div-org-edit-right">
                        
                    </div>
                </div>
                <div class="add-app-footer " >
                    <a href="<?=url('/web/papers/contract.php?num_app=' . $app->num_app);?>"
                    class="link-info _contract">Печать</a>
                   <a href="<?=url('/web/admin/tradingPlace/showTrPlace.php');?>" class="link-info" >  Закрыть</a>
                </div>
    </div>
</div>

<?php  file_include('/layers/footerAdmin.php'); ?>