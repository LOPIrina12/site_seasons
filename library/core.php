<?php
session_start();//Запуск встроенной в php функции для работы с сессиями на всех страницах

/* Функция отладки, использоуется только просмотра содержимого массива и объектов
в читаемом виде*/
function dump($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}

/*Функция определяет субдомен и добавляет его во все пути*/
function subdomain() {
    $root = $_SERVER['DOCUMENT_ROOT'];//корень сайта
    $subdomain = dirname(__DIR__);//текущее расположение файла core.php
    $subdomain = str_replace('\\', '/', $subdomain);// меняем обратные слеши на прямые
    $subdomain = str_replace($root, '', $subdomain);/*Вырезаем из текущего
    расположения файла путь до корня. Оставшаяся часть является субдоменом*/
    return $subdomain; // выводим результат из функции
}

/*Подключение файлов php к проекту с учетом субдомена
$title выводится в шапке сайта
*/
function file_include($path, $title = '') {
    include_once $_SERVER['DOCUMENT_ROOT'] . subdomain() . $path;
}

/*Генерация абсолютных адресов для сайта с учетом субдомена */
function url($path) {
	$url = 'http://' . $_SERVER["HTTP_HOST"];
	return $url . subdomain() . $path;
}


?>