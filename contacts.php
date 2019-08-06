<?php

    include 'library/core.php';
    file_include('/layers/header.php', 'Страница контактов');
?>

<div class="container">
    <h1>Контакты</h1>
    <div class="information">
        <div class="information-left">
            <h3 style="color: #FF8C19">Наш адрес:</h3>
            <p>Адрес: г. Минск, ул. В.Хоружей, 2<br>
            УНП 101322566 ЗАО "НИКООН"</p>
            <h3 style="color: #FF8C19">Режим работы ТРЦ:</h3>
            <p>Пн. - Вс. 10.00 - 20.00</p>
            
        </div>
        <div class="information-left">
            <h3 style="color: #FF8C19">Отдел аренды:</h3>
            <p>Иванов Иван Иванович +375 44 5-70-70-70<br>
            Режим работы:<br>
            Пн.-Пт.  10.00 - 17.30
            </p>
            <h3 style="color: #FF8C19">Администрация ТРЦ:</h3>
            <p>8(044)5-78-78-78<br>
            8(017)238-58-58</p>
        </div>
    </div>
    
    <div class="map">
        <script type="text/javascript" charset="utf-8" async 
    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1057351cfb97698d0cdb7ef71310cdd7246d77cd72afc89d116b4072adc826ec&amp;width=1200&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>
    
</div>

<?php file_include('/layers/footer.php'); ?>