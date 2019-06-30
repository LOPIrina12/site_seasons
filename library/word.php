<?php
file_include('/library/vendor/autoload.php');

class Word
{
    /*
     * @param $template - имя шаблона
     * @param $filename - имя файла для сохранения
     * @param array $option - массив переменных для замены
     */
    public static function template_word($template, $filename, $option = [])
    {
        $doc = "../../assets/files/templates/$template";// путь до файла шаблона
        $report = "../../assets/files/results/$filename";// путь для сохранения
        if (file_exists($doc)) {//проверяем наличие файла
            $phpWord = new \PhpOffice\PhpWord\PhpWord();// создаем экземпляр класса PhphWord
            $document = $phpWord->loadTemplate($doc);// загружаем шаблон
            // var_dump( $document);
            // die();
            foreach ($option as $var => $text) { // в цикле проходим массив переменных
                $document->setValue($var, $text);// меняем название переменных в файле на свои
            }
            $document->saveAs($report);//сохраняем документ
            if (file_exists($report)) {// проверяем наличие документа на сервере
                /*Отправляем заголовки браузеру, чтобы он интерпретировал ответ сервера,
                    как документ и отправил файл на сохранение пользователю*/
                header ("Content-Type: application/force-download");
                header ("Accept-Ranges: bytes");
                header ("Content-Length: ".filesize($report));
                header ("Content-Disposition: attachment; filename=".$filename);
                readfile($report);//читаем файл и отправляем его пользователю
            }
        }
    }
}

