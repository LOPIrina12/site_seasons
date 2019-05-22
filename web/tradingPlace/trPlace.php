<?php
    // Начало php кода
    // Страница контактов - example2.com/contact.php

    /*
     * Подключение файла с функциями, которые используются на этой странице
     * Так как файл находится в корне сайта, то выходить из текущей директории не требуется.
     * Мы заходим в папку library и обращаемся к файлу core.php
     * */
    include '../../library/core.php';
   
    /*
     * file_include - функция для подключения файлов.
     * См описание в файле /library/core.php
     * Подключаем шапку сайта. Здесь будет идти код из файла /layers/header.php
     * Вторым параметром идет название страницы, которое будет выводится в теге <title>
    */
    
    file_include('/library/Db.php');
    $db = new Db(); // Создаем экземпляр класса Db и записываем его в переменную $db
    $db->setQuery('SELECT * FROM `tradingPlace` WHERE rented = "0";');// Выполняем sql запрос
    $products = array(); // Формируем пустой массив $products
    if ($db->getNumRows()) { // Если товары найдены в базе
        /*
         * То получаем массив строчек из базы и сохраняем в переменную $products*/
        $products = $db->getObject();
    }
    $db->close();// Закрываем соединение с базой, т.к. на этой странице запросов больше не будет
    /*
     * Подключаем шапку сайта. Здесь будет идти код из файла /layers/header.php
     * Вторым параметром идет название страницы, которое будет выводится в теге <title>
    */
    file_include('/layers/header.php', 'Свободные помещения');
    
    // Завершение php кода
?>
<!--Начало HTML кода-->
<div class="content"><!--div контейнер для вывода контента сайта-->
    
    <!--Если массив товаров не пустой, то выводим товары в таблице-->
	
    <!--Таблица товаров с подключенным классом стилей simple-table
        См стили в файле /assets/css/style.css-->

    <div class="container">
        <h1>Свободные помещения</h1><!--Заголовок страницы-->

        <?php if($products): ?>

        <div class="table">
        <?php foreach ($products as $product): ?>
            <div class="table-item">
                <div class="table-item-body">
                    <div class="table-item-info">
                        <div class="table-row">
                            <strong>Код</strong>    
                            <span><?=$product->id_tradingPlace; ?></span>
                        </div>
                        <div class="table-row">
                            <strong>Номер торгового места</strong>    
                            <span><?=$product->number_place; ?></span>
                        </div>
                        <div class="table-row">
                            <strong>Площадь</strong>    
                            <span><?=$product->size_square	; ?></span>
                        </div>
                        <div class="table-row">
                            <strong>Ед.изм</strong>    
                            <span><?=$product->unit_measure; ?></span>
                        </div>
                        <div class="table-row">
                            <strong>Ставка</strong>    
                            <span><?=$product->rate	; ?></span>
                        </div>
                        <div class="table-row">
                            <strong>Ед.изм.</strong>    
                            <span><?=$product->unit_measure_; ?></span>
                        </div>
                        <div class="table-row">
                            <strong>Арендовано</strong>    
                            <span><?=$product->rented; ?></span>
                        </div>
                    </div>
                    <div class="table-item-img" >
                    
                        <img width="340px" height="230px" src="<?= url('/assets/img/tradingPlace/') . $product->image;?>">
                    </div>
                </div>
                <div class="table-item-footer">
                    <a href="<?=url('/web/application/applicationRent.php');?>" class="button button-primary">Оставить заявку</a>
                </div>
                
            </div>
        <?php endforeach; ?>
    </div>
    </div>

    <?php else: ?><!--Если товаров нет-->
        <p>Товары не найдены</p>
	<?php endif; ?><!--Закрываем условие проверки товаров-->
</div><!--Закрываем содержимое блока контент-->
<!--Завершение HTML кода-->
<!--Подключаем подвал сайта. Здесь будет идти код из файла /layers/footer.php-->
<?php file_include('/layers/footer.php'); ?>

<?php
    $test = 'stroka';
?>
<script type="text/javascript">
    var str = '<?php echo json_encode($products); ?>';
    str = JSON.parse(str);
    console.log(str);
</script>
    
    
   

<!--Начало HTML кода-->

<!--Завершение HTML кода-->
<!--Подключаем подвал сайта. Здесь будет идти код из файла /layers/footer.php-->
