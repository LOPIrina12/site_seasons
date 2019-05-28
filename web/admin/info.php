<?php
include '../../library/core.php';
file_include ('/library/Db.php');

access (['admin']);

file_include('/layers/header.php', 'Информация о заявке');

$num_contract = '';
$date_conctract = '';
$date_end_contract= '';
$processed = '';
$rented ='';








?>
<div class="container">
    <h1>Заявка №  от </h1>
        <div class="table-info">
            <div class="div-info-up">
                <div class="info-up-left">
                    <form class="form-edit" action="" method="POST">
                        <table class="table-edit">
                            <tr>
                                <th>Код </th>
                                <th>МИР</th>
                            </tr>
                            <tr>
                                <th>Организация</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>УНП</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>Адрес</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>Телефон</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>Е-mail</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>Контактное лицо</th>
                                <th>МИР</th>
                            </tr>
                           
                        </table>
                    </form>
                </div>
                
                <div class="info-up-right">
                    <form class="form-edit" action="" method="POST">
                        <table class="table-edit">
                             <tr>
                                <th>Код </th>
                                <th>МИР</th>
                            </tr>
                            <tr>
                                <th>Номер договора</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>Дата заключения договора</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>Дата окончания договора</th>
                                <th>МИР</th>
                            </tr>
                             <tr>
                                <th>Статус заявки</th>
                                <th>МИР</th>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            
            <div class="div-info-bot">
                <form class="form-edit" action="" method="POST">
                    <table>
                        <tr>
                            <th>Код</th>
                            <th>Номер торгового места</th>
                            <th>Площадь, м2</th>
                            <th>Ставка, $</th>
                            <th>Статус</th>
                        </tr>
                        <tr>
                            <td>М</td>
                            <td>М</td>
                            <td>М</td>
                            <td>М</td>
                            <td>М</td>
                        </tr>
                    </table>   
                </form>
            </div>
        </div>
</div>

<?php file_include('/layers/footer.php');?>